<?php
include('security.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $new_password = $_POST['password'];

    // Validate the new password
    if (strlen($new_password) < 8 || !preg_match("/[A-Z]/", $new_password) || !preg_match("/[a-z]/", $new_password) || !preg_match("/[0-9]/", $new_password)) {
        $_SESSION['status'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number";
        header('Location: reset-password.php');
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $query = "UPDATE register SET Password = ?, OTP = NULL WHERE Email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Password has been reset successfully";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['status'] = "Failed to reset password";
        header('Location: reset-password.php');
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    $_SESSION['status'] = "Unauthorized access";
    header('Location: login.php');
    exit();
}
?>
