<?php
session_start();
				
				if(isset($_SESSION['esid']))
				{
					echo "";					
				}
				else
				{
					header('location: ../login/');
				}	
        include '../connections.php';
$userid = $_SESSION['esid']; 
$sql="SELECT * FROM `login` WHERE `lid`='$userid'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eatsmart Admin </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body onload = "autoClick();">
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include 'partials/_navbar.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'partials/_sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header"> 
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home-outline"></i>
                </span> My Profile
              </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body ">
                      <h4 class="card-title">My Profile</h4>
                      <p class="card-description "><?php echo ($row['utype'] == 'admin') ? 'Admin' : 'User'; ?> </p>
                      <form class="forms-sample">
                        <div class="form-group">
                          <img class="profile-img" src="user_image/<?php echo $row['img']; ?>" />
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" disabled id="field01" placeholder="Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail3">Username</label>
                          <input type="text" class="form-control" name="username" id="field02" value="<?php echo $row['username']; ?>" disabled placeholder="UPI">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Email</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" disabled id="field01" placeholder="email">
                        </div>
                       
                      </form>
                    </div>
                  </div>
                </div>  
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include('footer.php') ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/qrcreate.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>