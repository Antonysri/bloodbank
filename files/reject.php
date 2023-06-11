<?php
    require 'connection.php';

   session_start();
    if(isset($_SESSION['brid'])){

        $brid = $_SESSION['brid'];

        // update the status

        $status = 'Rejected';
        $sql    = "UPDATE blood_request set status = ? where brid = ?";
        $stmt   = $conn->prepare($sql);
        $stmt->bind_param("si",$status,$brid);
        if($stmt->execute()){
            $error = "You have rejected the request";
            header("location:../blood_request.php?error=$error");
        }

    }
    





    ?>