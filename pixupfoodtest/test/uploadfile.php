<html>
    <head>
        <title>Ajax Image Upload Using PHP and jQuery</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <script src="script.js"></script>
    </head>
    <body>
        <div class="main">
            <h1>Ajax Image Upload</h1><br/>
            <hr>
            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">

                <hr id="line">
                <div id="selectImage">
                    <label>Select Your Image</label><br/>
                    <input type="file" name="file" id="file" required />
                    <input type="submit" value="Upload" class="submit" />
                </div>
            </form>
        </div>
        <h4 id='loading' >loading..</h4>
        <div id="message"></div>


        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function (e) {
                $("#uploadimage").on('submit', (function (e) {
                    e.preventDefault();
                    $("#message").empty();
                    $('#loading').show();
                    $.ajax({
                        url: "ajax_php_file.php", // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data)   // A function to be called if request succeeds
                        {
                            $('#loading').hide();
                            $("#message").html(data);
                        }
                    });
                }));




            });
        </script>
    </body>
</html>