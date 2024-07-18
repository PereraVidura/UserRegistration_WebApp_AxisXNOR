<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
        color: #333;
    }

    .container {
        max-width: 1000px;
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #007bff;
        text-align: center;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 15px 20px;
        color: inherit;
    }

    .alert-dismissible .close span {
        font-size: 20px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: separate;
        border-spacing: 0 10px;
        text-align: center;
    }

    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
        border-top: none;
        background: #fff;
        border-bottom: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: #007bff;
        color: #fff;
    }

    .table-bordered {
        border: none;
    }

    .table-bordered th, .table-bordered td {
        border: none;
    }

    .table img {
        border-radius: 5px;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-sm {
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
</style>

<div class="container py-5">
    <div class="col-md-12">
        <h2> View Users </h2>
        <hr>

        <!-- Display success message -->
        <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <!-- Display error message -->
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Profile Image</th>
                    <th>Added By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch user data
                $query = "SELECT * FROM users";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                        <tr>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['PhoneNumber']; ?></td>
                            <td><img src="profile_pics/<?php echo $row['ProfileImage']; ?>" alt="Profile Image" width="100"></td>
                            <td><?php echo $row['Added_by']; ?></td>
                            <td>
                                <form action="delete_user.php" method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                                    <input type="hidden" name="profile_image" value="<?php echo $row['ProfileImage']; ?>">
                                    <button type="submit" name="delete_btn" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('includes/footer.php');
?>
