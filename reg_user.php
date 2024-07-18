<?php include('security.php'); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: auto;
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #28a745;
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

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label p {
        font-size: 16px;
        color: #555;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #f7f7f7;
        font-size: 16px;
        color: #495057;
    }

    .form-input:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        width: 100%;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>

<div class="container py-5"> 
    <div class="col-md-8 offset-md-2"> 
        <h2> User Register </h2>
        <hr>

        <!-- Display success message -->
        <?php if(isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <!-- Display error message -->
        <?php if(isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <form id="registerForm" action="reg_user_code.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label><p>User Name:</p></label>
                <input type="text" class="form-input" name="name" id="name" required/>
            </div>

            <div class="form-group">
                <label><p>User Email:</p></label>
                <input type="email" class="form-input" name="email" id="email" required/>
            </div>

            <div class="form-group">
                <label><p>User Phone Number:</p></label>
                <input type="text" class="form-input" name="phone" id="phone" required/>
            </div>

            <div class="form-group">
                <label for="profileimage"><p>Upload User Profile Picture:</p></label>
                <input type="file" id="profileimage" name="profileimage" required>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Register"/>
            </div>
        </form>        
    </div>
</div>

<script>
    <?php if(isset($_SESSION['success']) && $_SESSION['success'] != '') { ?>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Clear form fields
            document.getElementById('registerForm').reset();
        });
    <?php } ?>
</script>

<?php include('includes/footer.php'); ?>
