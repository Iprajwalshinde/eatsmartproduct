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
    <title>Send Newsletter - EatSmart</title>
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
                </span> Send Newsletter
              </h3>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Mail</li>
                  </ol>
                </nav>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body ">
                      <h4 class="card-title">Send Newsletter</h4>
                      <p class="card-description ">Write Newletter to Sent</p>
                      <form id="addProduct" class="forms-sample" method="post" enctype="multipart/form-data"> <!-- action="pages/ajax/submit_product.php"-->
                          <div class="form-group">
                              <label for="exampleInputSubject">Mail Subject</label>
                              <input type="text" name="subjectMail" class="form-control" id="exampleInputSubject" placeholder="Subject" required>
                          </div>
                          
                          <div class="form-group">
                            <label for="messageMail">Mail Message</label>
                            <textarea name="messageMail" class="form-control" row="5" id="messageMail" placeholder="Mail Message"> </textarea>    
                          </div>
                        
                          <button type="submit" class="btn btn-gradient-primary me-2" id="submitForm">Submit</button>
                          

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
     
     let messageEditor;

ClassicEditor
    .create(document.querySelector('#messageMail'))
    .then(editor => {
        messageEditor = editor;
    })
    .catch(error => {
        console.error('Error initializing CKEditor:', error);
    });

    

    </script> 
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script>
    $(document).ready(function() {
        var submitButton = document.getElementById('submitForm');
        $('#addProduct').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            submitButton.innerHTML = `<span>Sending... <div class="loader-inline"></div></span>`;
            submitButton.disabled = true; // Disable the button to prevent multiple submits

            $('#loaderOnBtn').show();
            $.ajax({
                type: 'POST',
                url: 'pages/ajax/newsletterSender.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var messageElement = document.getElementById('message');
                    messageElement.style.color = 'green';
                    $('.message').html(response);
                    submitButton.disabled = false; // Re-enable the button
                    submitButton.innerHTML = 'Submit';
                    
                        $('#addProduct')[0].reset(); // Reset form on success
                        if (messageEditor) {
                    messageEditor.setData('');
                }        
                    },
                error: function() {
                  var messageElement = document.getElementById('message');
                  messageElement.style.color = 'red';
                    $('.message').html('Failed to Sent Mail');
                    submitButton.disabled = false; // Re-enable the button
                    submitButton.innerHTML = 'Submit';
                  }
            });
        });
    });
    </script>


    <!-- End custom js for this page -->
  </body>
</html>