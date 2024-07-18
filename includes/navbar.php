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
    $profileimage = "admin/uploads/" . $row['ProfileImage'];
} else {
    echo "No user data found";
    exit();
}
?>



<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
        MyCollege Website
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="faculties.php">Faculties</a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
        <a
          data-mdb-dropdown-init
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          aria-expanded="false"
        >
         Academics
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="#">Department of Physical Science</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Department of Bio Science</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Department of Arts</a>
          </li>
        </ul>
      </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->


        <!-- Right elements -->
    <div class="d-flex align-items-center">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <!-- Right links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="reg_user.php"> Register User </a> 
            </li> &nbsp;&nbsp;&nbsp;
            <li class="nav-item">
              <a class="nav-link" href="view_user.php"> View Users </a>
            </li> &nbsp;&nbsp;&nbsp;
          </ul>
          <!-- Right links -->

        </div>

      <!-- Avatar -->
      <div class="dropdown">
        <a
          data-mdb-dropdown-init
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          aria-expanded="false"
        >

        <span class="mr-2 d-none d-lg-inline" style="padding-right:5px;">
                                    
        <b> <?php echo $firstname; ?> <?php echo $lastname; ?> </b>
                            
        </span>

          <img
            src="<?php echo $profileimage; ?>"
            class="rounded-circle"
            height="40"
            alt="Profile Picture"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="admin/profile.php">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="admin/index.php">Settings</a>
          </li>
          <li>
          
          </li>
        </ul>
      </div> &nbsp;&nbsp;&nbsp;

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <!-- Right links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <form action="admin/logout.php" method="POST">
                  <button type="submit" name="logoutbtn" class="btn btn-primary">Logout</button>
              </form>
            </li>
          </ul>
          <!-- Right links -->

        </div>


    </div>
    <!-- Right elements -->

  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->