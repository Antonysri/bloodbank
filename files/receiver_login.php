    <?php
    require 'connection.php';
    session_start();

    function sanitizeInput($input , $filter = FILTER_DEFAULT){
        return filter_input(INPUT_POST,$input,$filter);
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['rlogin'])){
        
        $remail    = sanitizeInput('remail',FILTER_SANITIZE_EMAIL);
        $rPassword = htmlspecialchars($_POST['rpassword'],ENT_QUOTES,'UTF-8');


        echo $remail;
       
        $sql = "select * from receivers where r_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$remail);
        try{
            if($stmt->execute()){
                $result = $stmt->get_result();
                $row    = $result->fetch_assoc();
                if($result->num_rows > 0){
                    $hashPassword = $row['r_password'];

                    if(password_verify($rPassword,$hashPassword)){
                        $_SESSION['rid'] = $row['rid'];
                        $_SESSION['r_name'] = $row['r_name'];
        
                        $msg = $_SESSION['r_name']." you have logged in";
                        header("location:../send_request.php?msg=$msg");
                        exit;
                    }
                    else{
                        $error = "Invalid password please try again";
                        header("location:../login.php?error=$error");
                    }

                }
                else{
                    $error = "Invalid email address!!!please try again";
                    header("location:../login.php?error=$error");
                }

            }
            else{
                throw new Exception ("unable to connect database : ".$stmt->error);
            }

        }catch(Exception $e){
            echo ("error occurred : ".$e->getMessage());
        }
    }




 ?>


