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
    <title>Dashboard - EatSmart</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <?php include 'partials/_navbar.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include 'partials/_sidebar.php'; ?>
       
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home-outline"></i>
                </span> Welcome <?php echo ucfirst($row['name']); ?>!
              </h3>
             
            </div> 
            <div class="row c-pointer">         
              <div class="col-md-6 stretch-card grid-margin" onclick="location='pages/addProduct.php'">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" id="lnk1" alt="circle-image" />
                    <h2>Add Products</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-6 stretch-card grid-margin" onclick="location='pages/newsletterSend.php'">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" id="lnk1" alt="circle-image" />
                    <h2>Newsletter</h2>
                  </div>
                </div>
              </div>              
              <div class="col-md-6 stretch-card grid-margin" onclick="location='pages/reportFallacy.php'">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" id="lnk1" alt="circle-image" />
                    <h2>Report Fallacy</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-6 stretch-card grid-margin" onclick="location='profile.php'">
                <div class="card bg-gradient-primary card-img-holder text-white"> 
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h2>My Profile</h2>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>