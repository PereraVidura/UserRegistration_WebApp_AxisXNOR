<?php
include('security.php');

function generateOTP($length = 6) 
{
    $otp = '';
    for ($i = 0; $i < $length; $i++) 
    {
        $otp .= mt_rand(0, 9);
    }
    return $otp;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        // Check if email exists in the database
        $query = "SELECT * FROM register WHERE Email = ? LIMIT 1";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) 
        {
            // Generate OTP
            $otp = generateOTP();
            
            // Store OTP in the database
            $update_query = "UPDATE register SET OTP = ? WHERE Email = ?";
            $update_stmt = $connection->prepare($update_query);
            $update_stmt->bind_param("ss", $otp, $email);

            if ($update_stmt->execute()) 
            {
                $_SESSION['success'] = "OTP has been generated and stored in the database";
				header('Location: add-otp.php');
            }
            else 
            {
                $_SESSION['status'] = "Failed to store OTP";
				header('Location: forgot-password.php');
            }

            $update_stmt->close();
        } 
        else 
        {
            $_SESSION['status'] = "Email does not exist";
			header('Location: forgot-password.php');
        }

        $stmt->close();
        $conn->close();
    } 
    else 
    {
        $_SESSION['status'] = "Invalid email format";
		header('Location: forgot-password.php');
    }
    
}
?>
