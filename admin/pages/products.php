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
        include '../../connections.php';
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
    <title>Products - EatSmart</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <base href="../">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="qrcss.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include '../partials/_navbar.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include '../partials/_sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header"> 
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home-outline"></i>
                </span> Products List
              </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body ">
                      <h4 class="card-title">Information</h4>
                      <p class="card-description "></p>
                      <div class="table-responsive" id="reportTableContainer">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Date Time</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>ASIN</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="reportTableBody">
                                <!-- Records will be injected here by JavaScript -->
                            </tbody>
                            </table>
                            <div id="pagination"></div>
                      </div>
                      <div id="detailModal" class="modalDelete">
                        <div class="modal-content-Delete">
                            <button class="closeDelete" onclick="closeDelete()">&times;</button>
                            <h2 class="modal-title">Product Details</h2>
                            <div class="modal-body">
                                <strong>Date & Time</strong><p id="modalDateTime"></p>
                                <strong>Product Name</strong> <p id="modalTitle"></p>
                                <strong>Brand</strong><p id="modalDescription"></p>
                                <strong>ASIN</strong><p id="modalTag"></p>
                                <strong>Barcodes</strong><p id="modalReportTimes"></p>
                            </div>
                            <div class="modal-footer">
                                <button id="deleteButton" class="btn bg-gradient-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                      <div id="message" class="message"></div>
                    </div>
                  </div>
                </div>
                
                
              </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include('../footer.php') ?>
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
    <script src="assets/js/file-upload.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/products.js"></script>

    <!-- End custom js for this page -->
  </body>
</html>