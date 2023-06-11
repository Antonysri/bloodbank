<!DOCTYPE html>
<html>

<head>
  <title>Blood bank register</title>

<?php require 'head_4.php'; ?>
  </head>

<body>
  <?php require 'index.php';?>

  <div class="container cont">
  <?php require 'message.php'; ?>

<br>
  <div class="container cont">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
        <div class="card rounded">
          <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#hospitals">Hospitals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#receivers">Receivers</a>
            </li>
          </ul><br>
          <div class="tab-content">
                <!-- hospital registration-->
                <div class="tab-pane container show active" id="hospitals">
                <form action="files/hospital_reg.php" method="post" enctype="multipart/form-data" >
                    <input type="text" name="hname" placeholder="Hospital Name" class="form-control mb-3" required>
                    <input type="text" name="hcity" placeholder="Hospital City" class="form-control mb-3" required>
                    <input type="tel" name="hphone" placeholder="Hospital Phone Number" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="must be have 10 or 12 digit">
                    <input type="email" name="hemail" placeholder="Hospital Email" class="form-control mb-3" required>
                    <input type="password" name="hpassword" placeholder="Hospital Password" class="form-control mb-3"
                    required minlength="6">
                    <input type="submit" name="hregister" value="Register" class="btn btn-primary btn-block mb-4">
                </form>
                </div>
                    <!-- receiver registration-->
                <div class="tab-pane container fade show" id="receivers">
                <form action="files/receiver_reg.php" method="post" enctype="multipart/form-data" >
                    <input type="text" name="rname" placeholder="Receiver Name" class="form-control mb-3" required>
                    <select name="rbg" class="form-control mb-3" required>
                    <option disabled="" selected="">Blood Group</option>
                    <option value="A+" >A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    </select>
                    <input type="text" name="rcity" placeholder="Receiver City" class="form-control mb-3" required>
                    <input type="tel" name="rphone" placeholder="Receiver Phone Number" class="form-control mb-3" required
                    pattern="[0,6-9]{1}[0-9]{9,11}"
                    title="Mobile no. must start from 0,6,7,8 or 9 and must have 10 to 12 digits">
                    <input type="email" name="remail" placeholder="Receiver Email" class="form-control mb-3" required>
                    <input type="password" name="rpassword" placeholder="Receiver Password" class="form-control mb-3"
                    required minlength="6">
                    <input type="submit" name="rregister" value="Register" class="btn btn-primary btn-block mb-4">
                </form>
                </div>

          </div>
          <a href="login.php" class="text-center mb-4" title="Click here">Already have an account?</a>
        </div>
      </div>
    </div>
  </div>
  </div>


</body>

</html>
