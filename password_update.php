    <?php

    session_start();



    ?>

<?php if(isset($_SESSION['hid'])): ?>
<html>
    <head>
        <title>password update</title>
        <?php require 'head_4.php';?>
    </head>
    <body>
       
        <?php require 'message.php';?>
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
                <form action="files/update_password.php" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="hid" value = "<?php echo isset($_SESSION['hid']) ? $_SESSION['hid'] : '' ;?>">
                    <input type="password" class="form-control mb-3" name="old_password" placeholder="Enter old password"require minlength="6">
                    <input type="password" class="form-control mb-3" name="new_password" placeholder="Enter new password"require minlength="6">                   
                    
                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-block mb-4">
                    <div style="text-align: center;">
                    <a href="blood_request.php">Cancel</a>
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