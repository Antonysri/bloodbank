<?php

session_start();



?>

<?php if(isset($_SESSION['rid'])): ?>
<html>
<head>
    <title>password update</title>
    <?php require 'head.php';?>
</head>
<body>
   
   <?php require 'header.php';?>
    <?php require 'message.php';?>
    <br><br>
    <div class="container cont">
     <div class="row justify-content-center">
       <div class="col-lg-4 col-md-5 col-sm-6 col-xs-3 mb-7">
         <div class="card rounded">
         <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px">
        <li class="nav-item">
          <h3 class="font-weight-bold text-muted" >Password Update</h3>
        </li>
         </ul>
         <div class="tab-content">
         <div class="tab-pane container show active" id="hospitals"><br>
            <form action="files/r_update_password.php" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="rid" value = "<?php echo isset($_SESSION['rid']) ? $_SESSION['rid'] : '' ;?>">
                <input type="password" class="form-control mb-3" name="old_password" placeholder="Enter old password"require minlength="6">
                <input type="password" class="form-control mb-3" name="new_password" placeholder="Enter new password"require minlength="6">                   
                
                <input type="submit" name="update" value="Update" class="btn btn-primary w-100">
                <div style="text-align: center;">
                <a href="send_request.php">Cancel</a>
                </div>
            </form>
            </div>
         </div>
         </div>
       </div>
    </div>
    </div>
</body>
</html>

<?php endif;?>