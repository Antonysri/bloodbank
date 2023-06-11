    <?php 
    
    require 'connection.php';
    function sanitizeInput($input,$filter=FILTER_DEFAULT){
        return filter_input(INPUT_POST,$input,$filter);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update']) && $_POST['rid']){
       
        $rid     = $_POST['rid']; 
        $rname   =sanitizeInput('rname',FILTER_SANITIZE_STRING);
        $rbg     =  $_POST['rbg'];
        $rcity   = sanitizeInput('rcity',FILTER_SANITIZE_STRING);
        $rphone  = sanitizeInput('rphone',FILTER_SANITIZE_STRING);
        $remail = sanitizeInput('remail',FILTER_SANITIZE_EMAIL);
        // check email already exists
        $checkemail = "SELECT rid from receivers where r_email = ? and rid != ?";
        $stmt = $conn->prepare($checkemail);
        $stmt->bind_param("si",$remail,$rid);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
             $error = "This email already exists";
                header("location:../r_profile.php?error=$error");
        }
        else{
            //update the receiver data
            $update = "UPDATE receivers set r_name = ? , r_bg = ? , r_city = ? , r_phone = ? , r_email = ? where rid = ?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("sssssi",$rname,$rbg,$rcity,$rphone,$remail,$rid);
            if($stmt->execute()){
                $msg = "Your Profile Successfully Updated";
                header("location:../r_profile.php?msg=$msg");
            }
        }

        
       
    }
    $conn->close();



    ?>