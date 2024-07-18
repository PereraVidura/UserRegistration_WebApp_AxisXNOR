<?php
include('security.php');

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

    // Profile image upload
    $profileimage = $_FILES['profileimage']['name'];
    $target_dir = "profile_pics/";
    $target_file = $target_dir . basename($profileimage);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image file type
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['status'] = "Only JPG, JPEG, PNG, & GIF files are allowed.";
        header('Location: reg_user.php');
        exit();
    }

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['profileimage']['tmp_name']);
    if ($check === false) {
        $_SESSION['status'] = "File is not an image.";
        header('Location: reg_user.php');
        exit();
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['status'] = "Sorry, file already exists.";
        header('Location: reg_user.php');
        exit();
    }

    // Check file size (5MB max)
    if ($_FILES['profileimage']['size'] > 5000000) {
        $_SESSION['status'] = "Sorry, your file is too large.";
        header('Location: reg_user.php');
        exit();
    }

    // Attempt to move the uploaded file to the server
    if (!move_uploaded_file($_FILES['profileimage']['tmp_name'], $target_file)) {
        $_SESSION['status'] = "Sorry, there was an error uploading your file.";
        header('Location: reg_user.php');
        exit();
    }

    // Retrieve admin name from session
    $admin_username = $_SESSION['username'];

    // Fetch the first name of the admin
    $admin_query = "SELECT FirstName FROM register WHERE email = ?";
    $stmt = $connection->prepare($admin_query);
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $stmt->bind_result($admin_firstname);
    $stmt->fetch();
    $stmt->close();

    // Concatenate first name and username
    $added_by = $admin_firstname . " (" . $admin_username . ")";

    // Insert data into the database
    $query = "INSERT INTO users (Name, Email, PhoneNumber, ProfileImage, Added_by) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssss", $name, $email, $phone, $profileimage, $added_by);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User registered successfully!";
        header('Location: reg_user.php');
        exit();
    } else {
        $_SESSION['status'] = "User registration failed!";
        header('Location: reg_user.php');
        exit();
    }

    $stmt->close();
    $connection->close();
} else {
    $_SESSION['status'] = "Unauthorized access";
    header('Location: reg_user.php');
    exit();
}
?>