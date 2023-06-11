<?php

    require 'connection.php';
    function sanitizeInput($input,$filter=FILTER_DEFAULT){
        return filter_input(INPUT_POST,$input,$filter);
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['hregister'])){

        $hname        = sanitizeInput('hname',FILTER_SANITIZE_STRING);
        $hcity        = sanitizeInput('hcity',FILTER_SANITIZE_STRING);
        $hphone       = sanitizeInput('hphone',FILTER_SANITIZE_NUMBER_INT);
        $hemail       = sanitizeInput('hemail',FILTER_SANITIZE_EMAIL);
        $password     = htmlspecialchars($_POST['hpassword'],ENT_QUOTES,'UTF-8');
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);

        

        //check email already exists

        $checkmail = "select * from hospitals where h_email = ?";
        $stmt  =  $conn->prepare($checkmail);
        $stmt->bind_param("s",$hemail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $error_msg = "This email is already exists please try another email";
            header("location:../register.php?error=$error_msg");
        }
        else{
            $sql = "INSERT into hospitals (h_name,h_city,h_mobile,h_email,h_password) values(?,?,?,?,?)";
            $stmt=$conn->prepare($sql);
            $stmt->bind_param("sssss",$hname,$hcity,$hphone,$hemail,$hashpassword);
            try{   
                if($stmt->execute()){
                    $msg = 'You have successfully registered. Please, login to continue.';
                    header("location:../login.php?msg=$msg");
                }
                else{
                    throw new Exception("unable to connect database ".$stmt->error);
                }
            }
                catch(Exception $e){
                    echo ("error occurred : ".$e->getMessage());
                }
        }
        

    
    }



?>