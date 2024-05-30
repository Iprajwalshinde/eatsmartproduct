

        $(document).ready(function(){

            /*function readURL(input)
            {
                if(input.files && input.files[0])
                {
                    var reader = new FileReader();
            
                    reader.onload = function(event) {
                        $('#uploaded_image').attr('src', event.target.result);
                        $('#uploaded_image').removeClass('img-circle');
                        $('#upload_image').after('<div align="center" id="crop_button_area"><br /><button type="button" class="btn btn-primary" id="crop">Crop</button></div>')
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#upload_image").change(function() {
                readURL(this);
                var image = document.getElementById("uploaded_image");
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            });*/

            
            var $modal = $('#modal');
            var image = document.getElementById('sample_image');
            var cropper;

            //$("body").on("change", ".image", function(e){
            $('#upload_image').change(function(event){
                var files = event.target.files;
                var done = function (url) {
                    image.src = url;
                    $modal.modal('show');
                };
                //var reader;
                //var file;
                //var url;

                if (files && files.length > 0)
                {
                    /*file = files[0];
                    if(URL)
                    {
                        done(URL.createObjectURL(file));
                    }
                    else if(FileReader)
                    {*/
                        reader = new FileReader();
                        reader.onload = function (event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    //}
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#crop").click(function(){
                canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });

                canvas.toBlob(function(blob) {
                    //url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob); 
                    reader.onloadend = function() {
                        var base64data = reader.result;  
                        
                        $.ajax({
                            url: "upload.php",
                            method: "POST",                	
                            data: {image: base64data},
                            success: function(data){
                                console.log(data);
                                $modal.modal('hide');
                                $('#uploaded_image').attr('src', data);
                                 document.getElementById('typg').removeAttribute('disabled');
                                //alert("success upload image");
                            }
                        });
                    }
                });
            });
            
        });
 