     <?php  

     session_start();
     require 'connection.php';
     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_SESSION['bid']) && isset($_POST['delete'])){

        $bid   = $_SESSION['bid'];
        
        //delete bg in database

        $sql = "DELETE from bloodinfo where bid = ?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("i",$bid);
        if($stmt->execute()){
         $msg = "You have deleted one sample";
         header("location:../bloodAdd.php?msg=$msg");
        }
       
      
        
        
     }
     
     
     
     
     
     ?>