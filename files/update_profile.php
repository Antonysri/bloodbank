<?php
session_start();
require "connection.php";

// profile data update query

function sanitizeInput($input,$filter=FILTER_DEFAULT){
    return filter_input(INPUT_POST,$input,$filter);
}
        if (($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['hid'])) {

            $hid    = $_POST['hid'];
            $hname  = sanitizeInput('hname',FILTER_SANITIZE_STRING);
            $city   = sanitizeInput('hcity',FILTER_SANITIZE_STRING);
            $phone  = sanitizeInput('hphone',FILTER_SANITIZE_STRING);
            $hemail = sanitizeInput('hemail',FILTER_SANITIZE_STRING);
          

            // check if email already exists
            $checkemail = "SELECT h_email from hospitals where h_email = ? and hid != ?";
            $stmt = $conn->prepare($checkemail);
            $stmt->bind_param("si",$hemail,$hid);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $error = "This email already exists please try another email";
                header("location:../profile.php?error=$error");
                exit;
            }
            else{
               // update the database
           
               $update = "UPDATE hospitals set h_name = ? , h_city = ? , h_mobile = ? , h_email = ? where hid = ? ";
               $stmt   = $conn->prepare($update);
               $stmt->bind_param("ssssi",$hname,$city,$phone,$hemail,$hid);
               if($stmt->execute()){
                $msg = "Your Profile Successfully Updated";
                header("location:../blood_request.php?msg=$msg");
               }
               else{
                $error = "Something went wrong ".$stmt->error;
                header("location:../profile.php?error=$error");
            }
            }



            
        }
      
        ?>