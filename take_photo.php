<?php
$name = (isset($_POST['name']))?$_POST['name']:null;
$email = (isset($_POST['email']))?$_POST['email']:null;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verification</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <div>
        <div class="container"></div>
    </div>
    <div class="login-clean">
        <form  method="post">
            <h2 class="sr-only">Take photo</h2>
                <div id="success">
                    <h3>Picture Sended sucessfully</h3>
                </div>
                <div id="error">
                    <h3>Opps we have error on the server</h3>
                </div>
                <div id="itemform">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <video id="camera--view" width="240" height="315" autoplay playsinline></video>
                            <canvas class="hide" id="camera--sensor"></canvas>
                            <img class="hide img-responsive"  src="//:0" id="camera--output">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><button id="camera--retake" class="hide btn btn-primary btn-block" type="button">Retake </button></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><button  id="send--to-us" class="hide btn btn-primary btn-block" type="button">Send to us</button></div>
                        </div>
                    </div>

                </div>
                <div class="form-group"><button id="camera--trigger" class="btn btn-primary btn-block" type="button">Take photo</button></div>
                <div class="form-group"><a href="index.html" class="btn btn-primary btn-block" type="button">Back</a></div>
            </div>
            
            <input type="hidden" name="name" id="id_name" value="<?php print $name; ?>">
            <input type="hidden" name="email"id="id_email"  value="<?php print $email; ?>">
            <input type="hidden" id="camera--picture" name="picture">
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
    <script type="text/javascript">
        

        sendtoUs.onclick = function() {

            var name = document.querySelector("#id_name"),
            email = document.querySelector("#id_email"),
            picture = document.querySelector("#camera--picture"),
            success = document.querySelector("#success"),
            error = document.querySelector("#error"),
            itemform = document.querySelector("#itemform");

            
            $.post( "mailer.php",{
                name: name.value,
                email: email.value,
                picture: picture.value
            }, function( data ) 
            {
              if(data.success == true)
              {
                success.classList.remove("hide");
                itemform.classList.remove("hide");
                 error.classList.add("hide");
              }else
              {
                error.classList.remove("hide");
              }
            });  

        };

    </script>
</body>

</html>