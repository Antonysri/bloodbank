    <?php
    session_start();
     require 'connection.php';
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['hlogin'])){
        $hemail    = htmlspecialchars($_POST['hemail'],ENT_QUOTES,'UTF-8');
        $hpassword = htmlspecialchars($_POST['hpassword'],ENT_QUOTES,'UTF-8');
    
        $sql   = "select * from hospitals where h_email = ?";
        $stmt  = $conn->prepare($sql);
        $stmt->bind_param("s",$hemail);
        try{
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $hash_password = $row['h_password'];
                
                if(password_verify($hpassword,$hash_password)){
                    $_SESSION['hid']    = $row['hid'];
                    $_SESSION['h_name']  = $row['h_name'];

                    $msg= $_SESSION['h_name'].' have logged in.';
                    header("Location:../blood_request.php?msg=$msg");
                    exit;

                }
                else{
                    $error = "your password is wrong please try again";
                    header("location:../login.php?error=$error");
                }

            }
            else{
                $error = "invalid email please try again";
                header("location:../login.php?error=$error");
            }

        }
        else{
            throw new Exception("unable to connect database ".$stmt->error);
        }
    }catch(Exception $e){
        echo("error occurred : ".$e->getMessage());
    }

        
    }





    ?>