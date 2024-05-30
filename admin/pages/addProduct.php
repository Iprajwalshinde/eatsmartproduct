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
    <title>Add Product - EatSmart</title>
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
                </span> Add Product
              </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body ">
                      <h4 class="card-title">Add Product</h4>
                      <p class="card-description ">Product Details</p>
                      <form id="addProduct" class="forms-sample"  method="post" enctype="multipart/form-data"> <!-- action="pages/ajax/submit_product.php"-->
                          <div class="form-group">
                              <label for="exampleInputproductName">Product Name</label>
                              <input type="text" name="productName" class="form-control" id="exampleInputproductName" placeholder="Product Name" required>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputproductBrand">Product Brand</label>
                              <input type="text" name="productBrand" class="form-control" id="exampleInputproductBrand" placeholder="Product Brand" required>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputdataMessage">Share Message</label>
                              <input type="text" name="dataMessage" class="form-control" id="exampleInputdataMessage" placeholder="Share Message" required>
                          </div>
                          <div class="form-group">
                            <label>Product Image Upload</label>
                            <input type="file" accept="image/*" name="productImage" class="file-upload-default" required>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputquote">Quote</label>
                              <input type="text" name="quote" class="form-control" id="exampleInputquote" placeholder="Quote" required>
                          </div>
                          <div class="form-group">
                              <label for="exampleInputquoteBy">Quote By</label>
                              <input type="text" name="quoteBy" class="form-control" id="exampleInputquoteBy" placeholder="Quote By" required>
                          </div>
                        
                          <div class="form-group">
                            <label>Product Feature Image 1</label>
                            <input type="file" accept="image/*" name="productFeatureImg1" class="file-upload-default" required>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Product Feature Image 2</label>
                            <input type="file" accept="image/*" name="productFeatureImg2" class="file-upload-default"required>
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                                                  
                          <div class="form-group">
                              <label for="exampleInputBuyNow">Buy Now Link</label>
                              <input type="url" name="buyNow" class="form-control" id="exampleInputBuyNow" required placeholder="Buy Now Link">
                          </div>
                          
                          <div class="form-group">
                              <label for="exampleInputmanufacturer">Manufacturer</label>
                              <input type="text" name="manufacturer" class="form-control" id="exampleInputmanufacturer" required placeholder="Manufacturer">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputoriginCountry">Origin Country</label>
                              <input type="text" name="originCountry" class="form-control" id="exampleInputoriginCountry" required placeholder="Origin Country">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputasin">ASIN</label>
                              <input type="text" name="asin" class="form-control" id="exampleInputasin" required placeholder="ASIN">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputgenericName">Generic Name</label>
                              <input type="text" name="genericName" class="form-control" id="exampleInputgenericName" required placeholder="Generic Name">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputshelfLife">Shelf Life</label>
                              <input type="text" name="shelfLife" class="form-control" id="exampleInputshelfLife" required placeholder="Shelf Life">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputdateFirst">Date First</label>
                              <input type="date" name="dateFirst" class="form-control" id="exampleInputdateFirst" required placeholder="Date First">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputhowTake">How Take</label>
                              <input type="text" name="howTake" class="form-control" id="exampleInputhowTake" required placeholder="How Take">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputproteins">Proteins</label>
                              <input type="text" name="proteins" class="form-control" id="exampleInputproteins" required placeholder="Proteins">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputnutrition">Nutrition</label>
                              <input type="text" name="nutrition" class="form-control" id="exampleInputnutrition" required placeholder="Nutritions">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputcalories">Calories</label>
                              <input type="text" name="calories" class="form-control" id="exampleInputcalories" required placeholder="Calories">
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleInputShortDescription">Product Short Description</label>
                            <textarea name="ShortDescription" class="form-control" row="5" id="ShortDescription" placeholder="Product Short Description"> </textarea>    
                          </div>
                          <div class="form-group">
                            <label for="exampleInputproductDescription">Product Description</label>
                            <textarea name="productDescription" class="form-control" row="5" id="productDescription" required placeholder="Product Description"> </textarea>    
                          </div>
                          
                          <div class="form-group">
                              <label for="exampleInputbarcode1">Barcode 1</label>
                              <input type="number" name="barcode1" class="form-control" id="exampleInputbarcode1" required placeholder="Barcode 1">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputbarcode2">Barcode 2</label>
                              <input type="number" name="barcode2" class="form-control" id="exampleInputbarcode2" placeholder="Barcode 2">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputbarcode3">Barcode 3</label>
                              <input type="number" name="barcode3" class="form-control" id="exampleInputbarcode3" placeholder="Barcode 3">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputbarcode4">Barcode 3</label>
                              <input type="number" name="barcode4" class="form-control" id="exampleInputbarcode4" placeholder="Barcode 4">
                          </div>
                          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      </form>
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
    <script>
      ClassicEditor
        .create( document.querySelector( '#productDescription' ) )
        .catch( error => {
            console.error( error );
        } );
      ClassicEditor
        .create( document.querySelector( '#ShortDescription' ) )
        .catch( error => {
            console.error( error );
        } );
    </script> 
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
    $(document).ready(function() {
        $('#addProduct').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/ajax/submit_product.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    var messageElement = document.getElementById('message');
                    messageElement.style.color = 'green';
                    $('.message').html(data.message);
                    
                    console.log(data.message)
                    if(data.status == "success"){
                        $('#addProduct')[0].reset(); // Reset form on success
                    }
                },
                error: function() {
                  var messageElement = document.getElementById('message');
                  messageElement.style.color = 'red';
                    $('.message').html('An error occurred while submitting the form. Please try again.');

                  }
            });
        });
    });
    </script>


    <!-- End custom js for this page -->
  </body>
</html>