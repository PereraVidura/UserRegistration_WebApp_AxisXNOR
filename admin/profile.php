<?php
include('security.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$email_login = $_SESSION['username'];

$query = "SELECT * FROM register WHERE Email='$email_login'";
$query_run = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($query_run);

if ($row) {
    $id = $row['Id'];
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $email = $row['Email'];
    $profileimage = "uploads/" . $row['ProfileImage'];
} else {
    echo "No user data found";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #00bbf0;
            font-family: 'Arial', sans-serif;
        }
        .profile-card {
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: transform 0.3s ease-in-out;
        }
        .profile-card:hover {
            transform: translateY(-10px);
        }
        .profile-card table {
            width: 100%;
        }
        .profile-card img {
            border-radius: 50%;
            margin-bottom: 20px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #007bff;
        }
        .profile-card h4 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .profile-card h5 {
            margin: 10px 0;
            font-size: 18px;
            color: #666;
        }
        .profile-card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease-in-out;
        }
        .profile-card button:hover {
            background-color: #0056b3;
        }
        .profile-card a {
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease-in-out;
        }
        .profile-card a:hover {
            
        }
        .profile-card td {
            padding: 5px 0;
            vertical-align: middle;
        }
        .profile-card td:first-child {
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }
        .profile-card td:last-child {
            text-align: left;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card">
                    <div>
                        <h4>Profile</h4>
                    </div>

                    <?php
                    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
                    {
                        echo '<h6 class="container py-3" style="color: red; text-align: center;">' .$_SESSION['success']. '</h6>';
                        unset($_SESSION['success']);
                    }

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                    {
                        echo '<h6 class="container py-3" style="color: red; text-align: center;">' .$_SESSION['status']. '</h6>';
                        unset($_SESSION['status']);
                    }
                    ?>
                    
                    <img src="<?php echo $profileimage; ?>" alt="Profile Picture">

                    <table>
                        <tr>
                            <td>First Name:</td>
                            <td><span id="firstName"><?php echo $firstname; ?></span></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><span id="lastName"><?php echo $lastname; ?></span></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><span id="email"><?php echo $email; ?></span></td>
                        </tr>
                    </table>
                    
                    <form action="registeredit.php" method="POST">

                        <a href="../index.php" class="btn btn-danger">Back</a>

                        <input type="hidden" name="editid" value="<?php echo $id; ?>">
                        <button type="submit" name="editbtn" class="btn btn-success">Edit Profile</button>    
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
