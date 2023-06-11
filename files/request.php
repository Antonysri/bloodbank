<?php
    require 'connection.php';
    session_start();
    if (!isset($_SESSION['rid'])) {
        header("location:login.php");
        exit;
    }
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['hid'])){
    $hid = $_POST['hid'];
    $hname = $_POST['hname'];
    $hemail = $_POST['hemail'];
    $hcity = $_POST['hcity'];
    $hmobile = $_POST['hmobile'];
    $bg = $_POST['bg'];

     // Check if the request already exists in the database

     $check_request = "SELECT * from blood_request where hid = ? and rid = ?";
     $stmt = $conn->prepare($check_request);
     $stmt->bind_param("ii",$hid,$_SESSION['rid']);
     $stmt->execute();
     $result = $stmt->get_result();
     
     if($result->num_rows > 0){
        $error =  "You have already requested blood from this hospital.";
        header("location:../abs.php?error=$error");
        exit;
     }
     else{
        //insert into database
        $sql = "INSERT INTO blood_request(hid,rid,hname,hemail,hcity,hmobile,bg,status) values
        (?,?,?,?,?,?,?,'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssss",$hid,$_SESSION['rid'],$hname,$hemail,$hcity,$hmobile,$bg);
        if($stmt->execute()){
            $msg = "Blood request sent successfully.";
            header("location:../send_request.php?msg=$msg");
        }
        
        

     }

   }
   $conn->close();
   ?>