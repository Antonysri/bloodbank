  <?php 
  require 'connection.php';
  if(($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['hid'])){

    $hid  = $_POST['hid'];

    $sql = "DELETE from blood_request where hid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$hid);
    if($stmt->execute()){
        header("location:../send_request.php");
    }
  }


?>