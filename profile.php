<?php
session_start();
require 'files/connection.php';

// Check if the 'id' parameter exists in the URL
        if (isset($_SESSION['hid'])) {
            $hid = $_SESSION['hid'];

            //retrieve the data from database
            $sql = "SELECT * from hospitals where hid = ?";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("s",$hid);
            try{
                if($stmt->execute()){
                    $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                            $hname = $row['h_name'];
                            $hcity = $row['h_city'];
                            $hmobile = $row['h_mobile'];
                            $hemail = $row['h_email'];
                            $hpassword = $row['h_password'];
                        }

                }
                else{
                    throw new Exception("unable to connect in database ".$stmt->error);
                }

            }catch(Exception $e){
                echo ("error occurred : ".$e->getMessage());
            }

        }
        else{
            header("location:login.php");
        }
        
        ?>

<?php  if(isset($_SESSION['hid'])): ?>
<html>
    <head>
        <title>Hospital Profile</title>
        <?php require 'head_4.php'; ?>
    </head>
    <body>
       
        <?php require 'message.php';?>
        <div class="container cont">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-5 col-sm-6 col-7 mb-7">
      <div class="card rounded">
        <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px">
          <li class="nav-item">
            <h3 class="font-weight-bold text-muted">Hospital Profile</h3>
          </li>
        </ul>
        <div class="tab-content">
          <!-- hospital registration-->
          <div class="tab-pane container show active" id="hospitals"><br>
            <form action="files/update_profile.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="hid" value="<?php echo isset($hid) ? $hid : ''; ?>">
              <input type="text" name="hname" value="<?php echo isset($hname) ? $hname : ''; ?>" class="form-control mb-3" required>
              <input type="text" name="hcity" value="<?php echo isset($hcity) ? $hcity : ''; ?>" class="form-control mb-3" required>
              <input type="tel" name="hphone" value="<?php echo isset($hmobile) ? $hmobile : ''; ?>" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="Must have 10 or 12 digits">
              <input type="email" name="hemail" value="<?php echo isset($hemail) ? $hemail : ''; ?>" class="form-control mb-3" required>
              <input type="submit" name="update" value="Update" class="btn btn-primary btn-block mb-4">
              <div style="text-align: center;">
                <a href="password_update.php">Password update</a><br><br>
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
<?php endif; ?>