    <?php

    session_start();
    require 'files/connection.php';

    if(isset($_SESSION['rid'])){

        $rid = $_SESSION['rid'];
        //retrieve the data fro db

        $sql = "select * from receivers where rid= ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("i",$rid);
        try{
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row    = $result->fetch_assoc();
        
            $rname = $row['r_name'];
            $bg    = $row['r_bg'];
            $rcity = $row['r_city'];
            $rmobile = $row['r_phone'];
            $remail = $row['r_email'];
            $_SESSION['password'] = $row['r_password'];

        
        }
        else{
            throw new Exception("unable to connect database ".$stmt->error);
        }
    }catch(Exception $e){
        echo("error occurred : ".$e->getMessage());
    }
    }


    ?>
  <html>
    <head>
        <title>Hospital Profile</title>
        <?php require 'head.php'; ?>
    </head>
    <body>
     
       <?php require 'header.php';?>
        <?php require 'message.php';?>
        <br><br>
<div class="container cont">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-5 col-sm-6 col-7 mb-7">
      <div class="card rounded">
        <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px">
          <li class="nav-item">
            <h3 class="font-weight-bold text-muted">Receiver Profile</h3>
          </li>
        </ul>
        <div class="tab-content">
          <!-- hospital registration-->
          <div class="tab-pane container show active" id="hospitals"><br>
            <form action="files/r_update_profile.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="rid" value="<?php echo isset($_SESSION['rid']) ? $_SESSION['rid']:''; ?>">
              <input type="text" name="rname" value="<?php echo isset($rname) ? $rname:''; ?>" class="form-control mb-3">
              <select class="form-control mb-3" name="rbg" id="" >
              <option value="<?php echo $bg ;?>"><?php echo $bg;?></option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>

              </select>
              <input type="text" name="rcity" value="<?php echo isset($rcity) ? $rcity:''; ?>" class="form-control mb-3">
              <input type="tel" name="rphone"  value="<?php echo isset($rmobile) ? $rmobile:''; ?>"class="form-control mb-3"  pattern="[0,6-9]{1}[0-9]{9,11}" title="Must have 10 or 12 digits">
              <input type="email" name="remail" value="<?php echo isset($remail) ? $remail:''; ?>" class="form-control mb-3" >
              <input type="submit" name="update" value="Update" class="btn btn-primary w-100">

              <div style="text-align: center;">
                <a href="r_password_update.php">Password update</a><br><br>
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
<!-- value="<?php echo isset($hid) ? $hid : ''; ?>"
value="<?php echo isset($hname) ? $hname : ''; ?>"
value="<?php echo isset($hcity) ? $hcity : ''; ?>"
value="<?php echo isset($hmobile) ? $hmobile : ''; ?>"
value="<?php echo isset($hemail) ? $hemail : ''; ?>" -->