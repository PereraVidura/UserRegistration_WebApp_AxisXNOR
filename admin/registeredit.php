<?php include('security.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
                        <h4>Edit Profile</h4>
                    </div>
                    
                    

                    <?php
                    if(isset($_POST['editbtn']))
                    {
                        $id = $_POST['editid'];

                        $query = "SELECT * FROM register WHERE Id='$id'";
                        $query_run = mysqli_query($connection, $query);

                        foreach($query_run as $row)
                        {
                            ?>
                        
                        <form action="code.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="editid" value="<?php echo $row['Id'] ?>">

                        <div class="form-group">
                        <label for="editprofileimage">Profile Image:</label>
                        <input type="file" name="editprofileimage" class="form-control-file" id="editprofileimage">
                        </div>

                        <table>
                        <tr>
                            <td>First Name:</td>
                            <td><span id="firstName"> <input type="text" name="editfirstname" value="<?php echo $row['FirstName'] ?>"> </span></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><span id="lastName"> <input type="text" name="editlastname" value="<?php echo $row['LastName'] ?>"> </span></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><span id="email"> <input type="text" name="editemail" value="<?php echo $row['Email'] ?>"> </span></td>
                        </tr>
                        </table>

                        <a href="profile.php" class="btn btn-danger">Cancel</a> 
                        <button type="submit" name="updatebtn" class="btn btn-success">Update</button>  

                        </form>
                    
                            <?php
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
