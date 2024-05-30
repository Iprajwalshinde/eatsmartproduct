// barcodeScanner.js

document.getElementById('cameraIcon').addEventListener('click', function() {
    // Open the camera and start scanning for barcode
    openCamera();
});

function openCamera() {
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#barcodeScanner'),
            constraints: {
                width: 480,
                height: 320,
                facingMode: "environment" // or user
            },
        },
        decoder: {
            readers: ["ean_reader"]
        }
    }, function(err) {
        if (err) {
            console.error(err);
            return;
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
    });

    Quagga.onDetected(function(result) {
        handleBarcode(result.codeResult.code);
        Quagga.stop();
    });
}

function handleBarcode(barcode) {
    // Redirect to product.html with barcode as parameter
    window.location.href = `product.php?q=${barcode}`;
}
