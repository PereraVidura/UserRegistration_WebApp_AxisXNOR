<?php
include('security.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);

    // Log the received email and OTP for debugging
    error_log("Received email: $email and OTP: $otp");

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^\d{6}$/', $otp)) 
    {
        // Prepare the SQL query
        $query = "SELECT * FROM register WHERE Email = ? AND OTP = ? LIMIT 1";
        $stmt = $connection->prepare($query);

        if ($stmt) 
        {
            $stmt->bind_param("ss", $email, $otp);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) 
            {
                // OTP is correct, allow the user to reset the password
                $_SESSION['email'] = $email; // Store the email in the session for further use
                header('Location: reset-password.php');
                exit();
            } 
            else 
            {
                // Invalid OTP or email
                $_SESSION['error'] = "Invalid OTP or email";
                error_log("Invalid OTP or email for email: $email");
                header('Location: add-otp.php');
                exit();
            }

            $stmt->close();
        } 
        else 
        {
            // SQL statement preparation failed
            $_SESSION['error'] = "Database query failed: " . $connection->error;
            error_log("Database query failed: " . $connection->error);
            header('Location: add-otp.php'); //
            exit();
        }
    } 
    else 
    {
        // Invalid email or OTP format
        $_SESSION['error'] = "Invalid email or OTP format";
        error_log("Invalid email format or OTP format for email: $email, OTP: $otp");
        header('Location: add-otp.php');
        exit();
    }
} 
else 
{
    // Unauthorized access
    $_SESSION['error'] = "Unauthorized access";
    error_log("Unauthorized access attempt");
    header('Location: forgot-password.php');
    exit();
}


?>
