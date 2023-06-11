    <?php
     require 'connection.php';
     session_start();
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update']) && isset($_POST['rid'])){
          
          $rid          = $_POST['rid'];
          $old_password = $_POST['old_password'];
          $new_password = $_POST['new_password'];
          
          echo $rid.$old_password.$new_password;
     
          //retrive old password

        $check_password = "SELECT r_password from receivers where rid = ?";
        $stmt = $conn->prepare($check_password);
        $stmt->bind_param("i",$rid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row    = $result->fetch_assoc();

        $db_Password = $row['r_password'];
        // verify password
        if(password_verify($old_password,$db_Password)){
          //hash new password
          $new_password = password_hash($new_password,PASSWORD_DEFAULT);
          //update the password
          $update = "UPDATE receivers set r_password = ? where rid = ?";
          $stmt = $conn->prepare($update);
          $stmt->bind_param("si",$new_password,$rid);
          if($stmt->execute()){
               $msg = "your password successfully updated";
               header("location:../send_request?msg=$msg");
               exit;
          }
          
        }
        else{
          $error = "old password is wrong please check";
          header("location:../r_password_update?error=$error");
          exit;
        }
         
  



     }
     else{
          die ("it s not connect".$conn->error);
     }
     $stmt->close();
     $conn->close();
    ?>