        <?php
        session_start();
        require 'connection.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']) && !empty($_POST['bg'])  && isset($_SESSION['hid'])) {
            
        $blood = $_POST['bg'];
        $hid   = $_SESSION['hid'];
        //check bg already exists
        $checkbg = "SELECT bid from bloodinfo where bgroup = ? and hid = ?";
        $stmt = $conn->prepare($checkbg);
        $stmt->bind_param("si",$blood,$hid);
        $stmt->execute();
        $result = $stmt->get_result();     
       
        if($result->num_rows > 0){
            $error = "This blood group already in your hospital";
            header("location:../bloodAdd.php?error=$error");
            exit;
        }    
        else{
                //insert bg
                $sql = "INSERT into bloodinfo(hid,bgroup) values (?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is",$hid,$blood);
                try{
                    if($stmt->execute()){
                        $msg = "you have been successfully added blood group";
                        header("location:../bloodAdd.php?msg=$msg");
                    }
                    else{
                        throw new Exception("unable to connect database ".$stmt->error);
                    }
                }catch(Exception $e){
                    echo ("Error occurred : ".$e->getMessage());
                }
            } 
    }

    else {
            echo '<script>alert("Please add a blood group");
            window.location.href = "../bloodAdd.php";</script>';
            exit;
    }
        ?>
