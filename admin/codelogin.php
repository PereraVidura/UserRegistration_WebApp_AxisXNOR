<?php
include('security.php');

if (isset($_POST['loginbtn'])) {
    $email_login = trim($_POST['email']);
    $password_login = $_POST['password'];

    // Validate email
    if (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format";
        header('Location: login.php');
        exit();
    }

    // Prepare the SQL statement
    $query = "SELECT * FROM register WHERE Email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $email_login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verify the password
        if (password_verify($password_login, $row['Password'])) {
            $_SESSION['username'] = $email_login;
            header('Location: ../index.php');
        } else {
            $_SESSION['status'] = "Your Email or Password is Invalid";
            header('Location: login.php');
        }
    } else {
        $_SESSION['status'] = "Your Email or Password is Invalid";
        header('Location: login.php');
    }

    mysqli_stmt_close($stmt);
}
?>
