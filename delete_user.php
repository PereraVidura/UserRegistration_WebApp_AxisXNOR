<?php
include('security.php');

if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];
    $profile_image = $_POST['profile_image'];

    // Delete the user record from the database
    $query = "DELETE FROM users WHERE Id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete the profile image from the server
        if (file_exists("profile_pics/" . $profile_image)) {
            unlink("profile_pics/" . $profile_image);
        }

        $_SESSION['success'] = "User deleted successfully!";
        header('Location: view_user.php');
        exit();
    } else {
        $_SESSION['status'] = "Failed to delete user!";
        header('Location: view_user.php');
        exit();
    }

    $stmt->close();
    $connection->close();
} else {
    $_SESSION['status'] = "Unauthorized access";
    header('Location: view_user.php');
    exit();
}
?>
