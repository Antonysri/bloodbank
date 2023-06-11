<?php
   require 'connection.php';
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])){
        
        $hid          = $_POST['hid'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        //check the old password query

        $check_password = "SELECT h_password from hospitals where hid = ?";
        $stmt = $conn->prepare($check_password);
        $stmt->bind_param("i",$hid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row    = $result->fetch_assoc();

        $db_Password = $row['h_password'];

        if(password_verify($old_password,$db_Password)){
            $new_password_hash = password_hash($new_password,PASSWORD_DEFAULT);
            //update the password
            $update = "UPDATE hospitals set h_password = ? where hid = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("si",$new_password_hash,$hid);
            if($stmt->execute()){
                $msg = "Password is successfully updated";
                header("location:../blood_request.php?msg=$msg");
            }

        }
        else{
            $error = "Old password is wrong please check the password";
            header("location:../password_update.php?error=$error");
            exit;
        }
   }



?>