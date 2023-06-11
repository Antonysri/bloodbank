    <?php
    require 'connection.php';

    function sanitizeInput($input,$filter=FILTER_DEFAULT){
        return filter_input(INPUT_POST,$input,$filter);
    }
    

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['rregister'])){
        $rname      = sanitizeInput('rname',FILTER_SANITIZE_STRING);
        $rbg        = sanitizeInput('rbg',FILTER_SANITIZE_STRING);
        $rcity      = sanitizeInput('rcity',FILTER_SANITIZE_STRING);
        $rphone     = sanitizeInput('rphone',FILTER_SANITIZE_NUMBER_INT);
        $remail     = sanitizeInput('remail',FILTER_SANITIZE_EMAIL);
        $password   = htmlspecialchars($_POST['rpassword'],ENT_QUOTES,'UTF-8');

        echo "worked : ".$rname;

        //check email already exists
        $checkmail  = "select r_email from receivers where r_email= ?";
        $stmt  = $conn->prepare($checkmail);
        $stmt->bind_param("s",$remail);
        try{
        if($stmt->execute()){

            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $error = "This email is already exists please try another email";
                header("location:../register.php?error=$error");
            }
            else{
                $hashpassword = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT into receivers(r_name,r_bg,r_city,r_phone,r_email,r_password) values (?,?,?,?,?,?)";
                $stmt= $conn->prepare($sql);
                $stmt->bind_param("ssssss",$rname,$rbg,$rcity,$rphone,$remail,$hashpassword);
                try{
                    if($stmt->execute()){
                        $msg = "your registration successfully.. please login";
                        header("location:../login.php?msg=$msg");
                    }
                    else{
                        throw new Exception("unable to connect database : ".$stmt->error);
                    }
                }catch(Exception $e){
                        echo ("error occurred : ".$e->getMessage());
                }
            }

        }
        else{
            throw new Exception("unable to connect database : ".$stmt->error);
        }
    }catch(Exception $e){
            echo ("error occurred : ".$e->getMessage());
    }




    }



    ?>