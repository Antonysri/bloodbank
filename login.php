
<!DOCTYPE html>
<html>
<head>
<title>BloodBank</title>
<?php require 'head_4.php';?>
</head>
<body>
<?php require 'index.php';?>
    <br>
    <?php require 'message.php' ;?>

    <div class="container cont">
      
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">

                <div class="card rounded">
                        <!-- top heading links-->
                        <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px;">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#hospitals">Hospitals</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#receivers">Receivers</a>
                        </li>
                        </ul>

                        <div class="tab-content">
                                <!-- hospital login -->
                            <div class="tab-pane container active" id="hospitals">
                                <form action="files/hospital_login.php" method="post" enctype="multipart/form-data">
                                <label class="text-muted font-weight-bold">Hospital Email</label>
                                <input type="email" name="hemail" placeholder="Hospital Email" class="form-control mb-4">
                                <label class="font-weight-bold text-muted" >Hospital Password</label>
                                <input type="password" name="hpassword" placeholder="Hospital Password" class="form-control mb-4">
                                <input type="submit" name="hlogin" value="Login" class="btn btn-primary btn-block mb-4">
                                </form>
                            </div>

                            <!-- receiver login -->
                            <div class="tab-pane container fade" id="receivers">
                                <form action="files/receiver_login.php" method="post">
                                <label class="text-muted font-weight-bold" class="text-muted font-weight-bold">Receiver Email</label>
                                <input type="email" name="remail" placeholder="Receiver Email" class="form-control mb-4">
                                <label class="text-muted font-weight-bold" class="text-muted font-weight-bold">Receiver Password</label>
                                <input type="password" name="rpassword" placeholder="Receiver Password" class="form-control mb-4">
                                <input type="submit" name="rlogin" value="Login" class="btn btn-primary btn-block mb-4">
                                </form>
                            </div>

                        </div>
                        <a href="register.php" class="text-center mb-4" title="Click here">Don't have account?</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
