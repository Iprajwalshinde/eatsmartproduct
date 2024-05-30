<?php 
$nameBarcode = $_GET['q'];
if($nameBarcode){
    // Connect to the database
    include 'connections.php';
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     
    // Escape the variable to help protect against SQL injections
    $nameBarcode = $conn->real_escape_string($nameBarcode);
    
    // SQL query
    $sql = "SELECT * FROM products WHERE barcode1='$nameBarcode' OR barcode2='$nameBarcode' OR barcode3='$nameBarcode' OR barcode4='$nameBarcode' OR productName='$nameBarcode'";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
           ?>
           <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>EatSmart Product Page</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">
        <link href="css/chat_bot.css" rel="stylesheet">       


    </head>
    
    <body id="top">
    <div id="chat-icon"></div>
            <div id="chat-window">
                <div id="chat-header">
                <span id="chat-title">EatSmart ChatAI</span>
                <button id="close-button" aria-label="Close chat window">✕</button>
                </div>
                <div id="chat-history"></div>
                <div id="input-area">
                <input type="text" id="user-message" placeholder="Type your question...">
                <button id="send-button">Send</button>
            </div>
        </div>
        <main>

        <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="index.html">
                        <span class="logoES">EatSmart</span>
                    </a>

                    <div class="d-lg-none ms-auto me-4">
                        <a href="admin/index.php" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-5 me-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.html#hero">Home</a>
                            </li>

                            
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="./insights.html">Insights</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="index.html#about">About</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#work">How It Work</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="index.html#faqs">FAQs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./contact.html">Contact</a>
                            </li>
                                                 
                        </ul>

                        <div class="d-none d-lg-block">
                            <a href="admin/index.php" class="navbar-icon bi-person smoothscroll"></a>
                        </div>
                    </div>
                </div>
            </nav>

            

            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-lg-5 col-12 mb-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Homepage</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                                </ol>
                            </nav>

                            <h2 class="text-primary-color"><?php echo ucwords($row['productName']); ?></h2>
                            <h7 class="text-primary-color">Brand: <?php echo ucwords($row['productBrand']); ?></h7>

                            <div class="d-flex align-items-center mt-5">
                                <a href="#product-detail" class="btn custom-btn custom-border-btn smoothscroll me-4">Read More</a>

                                <a href="javascript:void(0);" class="custom-icon bi-share smoothscroll" onclick="openShareMenu(event)" data-message="<?php echo ucfirst($row['dataMessage']); ?>"></a>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12">
                            <div class="topics-detail-block bg-white shadow-lg">
                                <img src="images/product/<?php echo ucwords($row['productImage']); ?>" class="topics-detail-block-image img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </header>


            <section class="topics-detail-section section-padding" id="product-detail">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 m-auto text-align-justify">
                            <h3 class="mb-4">Product Description</h3>

                            <p>
                                <?php echo ucfirst($row['productDescription']); ?>           
                            </p>

                            
                            <blockquote>
                                ❝<?php echo ucfirst($row['quote']); ?>❞
                                <br>
                                <br>
                                <span>— <?php echo ucwords($row['quoteBy']); ?></span>
                            </blockquote>

                            <div class="row my-4">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <img src="images/product/<?php echo ucwords($row['productFeatureImg1']); ?>" class="topics-detail-block-image img-fluid">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-lg-0 mt-md-0">
                                    <img src="images/product/<?php echo ucwords($row['productFeatureImg2']); ?>" class="topics-detail-block-image img-fluid">
                                </div>
                            </div>

                            <p>
                                <?php echo ucwords($row['ShortDescription']); ?>
                            </p>

                           <a href="<?php echo $row['buyNow'];  ?>" class="centerlise"> <button class="custom-btn mt-4 centerlise">Buy Now</button></a>

                            <h5 class="tableHead5">General Details</h5>
                            <div class="table-responsive text-align-left">
                                <table class="table table-striped">
                                    <tbody>
                                      <tr>
                                        <th scope="row">Manufacturer</th>
                                        <td><?php echo ucwords($row['manufacturer']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Brand</th>
                                        <td><?php echo ucwords($row['productName']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Country of Origin</th>
                                        <td><?php echo ucwords($row['originCountry']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Item Model No. (Bardcode)</th>
                                        <td><?php echo ucwords($row['barcode1']); ?><br><?php echo ucwords($row['barcode2']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ASIN</th>
                                        <td><?php echo $row['asin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Generic Name</th>
                                        <td><?php echo ucwords($row['genericName']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Maximum Shelf Life</th>
                                        <td><?php echo $row['shelfLife']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date First Available</th>
                                        <td><?php echo (new DateTime($row['dateFirst']))->format("d F Y"); ?></td>
                                      </tr>
                                      
                                    </tbody>
                                  </table>
                              </div>
                        </div>
                        
                        <div class="col-lg-8 col-12 m-auto text-align-justify mt-50 mb-4">
                            <div class="list list-row block">
                                <div class="list-item">
                                   <div><span class="w-48 avatar gd-icon"><img class="image" src="images/icons/spoon.png" alt="Icon"></span></div>
                                   <div class="flex">
                                      Take
                                      <div class="item-except text-muted text-sm "><?php echo ucfirst($row['howTake']); ?></div>
                                   </div>
                                  
                                </div>
                                <div class="list-item">
                                   <div><span class="w-48 avatar gd-icon"><img class="image" src="images/icons/protein.png" alt="Icon"></span></div>
                                   <div class="flex">
                                        Protein
                                      <div class="item-except text-muted text-sm "><?php echo ucfirst($row['proteins']); ?></div>
                                   </div>
                                  
                                </div>
                                <div class="list-item">
                                   <div><span class="w-48 avatar gd-icon"><img class="image" src="images/icons/nutrition.png" alt="Icon"></span></div>
                                   <div class="flex">
                                      Nutrition
                                      <div class="item-except text-muted text-sm"><?php echo ucfirst($row['nutrition']); ?></div>
                                   </div>
                                  
                                </div>
                                <div class="list-item icon-last">
                                   <div><span class="w-48 avatar gd-icon "><img class="image" src="images/icons/Calorie.png" alt="Icon"></span></div>
                                   <div class="flex">
                                        Calorie
                                      <div class="item-except text-muted text-sm "><?php echo ucfirst($row['calories']); ?></div>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="Calorie.html" class="centerlise"> <button class="custom-btn mt-4 centerlise">Calculate Calorie</button></a>
            </section>


            <section class="section-padding section-bg">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-5 col-12">
                            <img src="images/rear-view-young-college-student.jpg" class="newsletter-image img-fluid" alt="">
                        </div>

                        <div class="col-lg-5 col-12 subscribe-form-wrap d-flex justify-content-center align-items-center">
                        <form class="custom-form subscribe-form" action="#" method="post" role="form" id="newsletter-form">
                            <h4 class="mb-4 pb-2">Get Newsletter</h4>
                            <input type="email" name="subscribe-email" id="subscribe-email" class="form-control" placeholder="Email Address" required="">
                            <div class="col-lg-12 col-12">
                                <button type="submit" class="form-control" id="subscribe-button">Subscribe</button>
                            </div>
                            <div id="message" class="message"></div>
                        </form>
                        </div>

                    </div>
                </div>
            </section>
        </main>
		
        <footer class="site-footer section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-12 mb-4 pb-2">
                        <a class="navbar-brand mb-2" href="index.html">
                            <span class="logoES">EatSmart</span>
                        </a>
                        <p data-content="paragraph">Uncover the real scoop on products with our community-driven platform</p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="site-footer-title mb-3">Resources</h6>

                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="index.html#hero" class="site-footer-link">Home</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="index.html#work" class="site-footer-link">How it works</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="index.html#faqs" class="site-footer-link">FAQs</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="./insights.html" class="site-footer-link">Insights</a>
                            </li>
                            <li class="site-footer-link-item">
                                <a href="./contact.html" class="site-footer-link">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                        <h6 class="site-footer-title mb-3">Information</h6>
                        <p class="text-white d-flex mb-1">
                            <a href="tel:  +91 79994 54660" class="site-footer-link">
                                +91 79994 54660
                            </a>
                        </p>
                        <p class="text-white d-flex">
                            <a href="mailto:info@company.com" class="site-footer-link">
                                info@EatSmart.com
                            </a>
                        </p>
                    </div>
                        <p class="copyright-text mt-lg-5 mt-4">Copyright © 2024 EatSmart. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/share.js"></script>
        <script src="js/chatbot.js"></script>
        <script>
           $(document).ready(function() {
                $('#newsletter-form').submit(function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    var email = $('#subscribe-email').val();
                    var button = $('#subscribe-button');
                    var message = $('#message');

                    button.html('<div class="loader"></div>'); // Add loader to button
                    message.removeClass('success error');

                    $.ajax({
                        type: "POST",
                        url: "subscribe.php",
                        data: {email: email},
                        success: function(data) {
                            message.addClass('success').html(data); // Display success message
                            button.text('Subscribe'); // Reset button text
                        },
                        error: function() {
                            message.addClass('error').html('Failed to subscribe.'); // Display error message in red
                            button.text('Subscribe');
                        }
                    });
                });
            });

        </script>
    </body>
</html>
           
           <?php
        }
    } else {
        echo "0 results";

        // redirect no product found
    }
    
    // Close connection
    $conn->close();
    
}
else{
    //code
    // redirect not found
}

?>
