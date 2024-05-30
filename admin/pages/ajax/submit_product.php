<?php
// Database connection
include '../../../connections.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random filename
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $productName = $_POST['productName'];
    $productBrand = $_POST['productBrand'];
    $dataMessage = $_POST['dataMessage'];
    $quote = $_POST['quote'];
    $quoteBy = $_POST['quoteBy'];
    $buyNow = $_POST['buyNow'];
    $manufacturer = $_POST['manufacturer'];
    $originCountry = $_POST['originCountry'];
    $asin = $_POST['asin'];
    $genericName = $_POST['genericName'];
    $shelfLife = $_POST['shelfLife'];
    $dateFirst = $_POST['dateFirst'];
    $howTake = $_POST['howTake'];
    $proteins = $_POST['proteins'];
    $nutrition = $_POST['nutrition'];
    $calories = $_POST['calories'];
    $productDescription = $_POST['productDescription'];
    $barcode1 = $_POST['barcode1'];
    $barcode2 = $_POST['barcode2'];
    $barcode3 = $_POST['barcode3'];
    $barcode4 = $_POST['barcode4'];
    $ShortDescription = $_POST['ShortDescription'];

    // Handle file upload
    $productImageName = generateRandomString() . '.' . pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION);
    $productFeatureImg1Name = generateRandomString() . '.' . pathinfo($_FILES['productFeatureImg1']['name'], PATHINFO_EXTENSION);
    $productFeatureImg2Name = generateRandomString() . '.' . pathinfo($_FILES['productFeatureImg2']['name'], PATHINFO_EXTENSION);

    // Move files to target directory
    move_uploaded_file($_FILES['productImage']['tmp_name'], "../../../images/product/" . $productImageName);
    move_uploaded_file($_FILES['productFeatureImg1']['tmp_name'], "../../../images/product/" . $productFeatureImg1Name);
    move_uploaded_file($_FILES['productFeatureImg2']['tmp_name'], "../../../images/product/" . $productFeatureImg2Name);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO products (productName, productBrand, dataMessage, productImage, quote, quoteBy, buyNow, productFeatureImg1, productFeatureImg2, manufacturer, originCountry, asin, genericName, shelfLife, dateFirst, howTake, proteins, nutrition, calories, productDescription, barcode1, barcode2, barcode3, barcode4, ShortDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssssssssssss", $productName, $productBrand, $dataMessage, $productImageName, $quote, $quoteBy, $buyNow, $productFeatureImg1Name, $productFeatureImg2Name, $manufacturer, $originCountry, $asin, $genericName, $shelfLife, $dateFirst, $howTake, $proteins, $nutrition, $calories, $productDescription, $barcode1, $barcode2, $barcode3, $barcode4, $ShortDescription);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Product added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error adding product: " . $stmt->error]);
    }
    $stmt->close();
}
$conn->close();
?>
