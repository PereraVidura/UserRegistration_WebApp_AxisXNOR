<?php
include('security.php');

if (isset($_POST['registerbtn'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $profileimage = $_FILES['profileimage']['name'];
    $howhear = $_POST['howhear'];
    $gender = $_POST['gender'];
    $agreeterm = isset($_POST['agreeterm']) ? 1 : 0;

    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate phone number
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors[] = "Invalid phone number format";
    }

    // Ensure the passwords match and meet criteria
    if ($password !== $cpassword) {
        $errors[] = "Password and Confirm Password do not match";
    } elseif (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors[] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number";
    }

    // Ensure the profile image is uploaded successfully
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profileimage);
    if (!move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
        $errors[] = "There was an error uploading the image";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database using prepared statements
        $query = "INSERT INTO register (FirstName, LastName, Email, Address, PhoneNumber, Password, ProfileImage, HowHear, Gender, AgreeTerm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssi", $firstname, $lastname, $email, $address, $phone, $hashed_password, $profileimage, $howhear, $gender, $agreeterm);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Profile added successfully";
            header('Location: login.php');
        } else {
            $_SESSION['status'] = "There was an error adding your profile. Please try again later.";
            header('Location: register.php');
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = implode('<br>', $errors);
        header('Location: register.php');
    }
}




if(isset($_POST['updatebtn'])) 
{
    $id = $_POST['editid'];
    $firstname = $_POST['editfirstname'];
    $lastname = $_POST['editlastname'];
    $email = $_POST['editemail'];

    // Handle profile image upload
    if(isset($_FILES['editprofileimage']) && $_FILES['editprofileimage']['error'] === UPLOAD_ERR_OK) 
    {
        $file_tmp = $_FILES['editprofileimage']['tmp_name'];
        $file_name = $_FILES['editprofileimage']['name'];
        $file_destination = 'uploads/' . $file_name;

        // Move uploaded file to desired directory
        move_uploaded_file($file_tmp, $file_destination);

        // Update database with profile image path
        $query = "UPDATE register SET FirstName='$firstname', LastName='$lastname', Email='$email', ProfileImage='$file_name' WHERE Id='$id'";
    } 
    else 
    {
        // If no new image uploaded, update only other fields
        $query = "UPDATE register SET FirstName='$firstname', LastName='$lastname', Email='$email' WHERE Id='$id'";
    }

    $query_run = mysqli_query($connection, $query);

    if($query_run) 
    {
        $_SESSION['username'] = $email;  // Update session email if changed
        $_SESSION['success'] = "Your account has been updated successfully";

        // Fetch updated user data
        $query = "SELECT * FROM register WHERE Id='$id'";
        $query_run = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($query_run);

        if ($row) {
            // Update session variables
            $_SESSION['username'] = $row['Email'];
            $_SESSION['firstname'] = $row['FirstName'];
            $_SESSION['lastname'] = $row['LastName'];
            $_SESSION['profileimage'] = $row['ProfileImage'];
        }

        header('Location: profile.php');
    } 
    else 
    {
        $_SESSION['status'] = "Your data was not updated";
        header('Location: profile.php');
    }
}


?>