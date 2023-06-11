<?php require 'session_expired.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand"   href="index.php">BloodBank Management System</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  
      
    <?php if(isset($_SESSION['hid'])): ?>
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link btn btn-light" href="blood_request.php">Blood Request <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-light" href="bloodAdd.php">Add blood Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-light" href="abs.php">Available Blood Sample</a>
        </li>
        
        <li style="margin-left: 650;" class="nav-item">
            <a class="nav-link btn btn-light" style="margin-top:12;" href="profile.php"><mark><?php echo isset($_SESSION['h_name']) ? $_SESSION['h_name'] : ''; ?></mark></a>
        </li>
        </ul>
        
           <button style="margin-left: 30;" class="btn btn-danger"><a style="text-decoration: none;" class= "text-light" href="logout.php">Logout</a></button>
       
          
     <?php elseif(isset($_SESSION['rid'])):?>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link btn btn-light" style="margin-top: 7;" href="send_request.php">Sent Blood Request <span class="sr-only"></span></a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link btn btn-light"style="margin-top: 7;" href="abs.php">Available Blood Sample</a>
        </li>
        
        <li style="margin-left: 650;" class="nav-item">
            <a class="nav-link btn btn-light" style="margin-top:12;" href="r_profile.php"><mark><?php echo isset($_SESSION['r_name']) ? $_SESSION['r_name'] : $_SESSION['r_name'];?></mark></a>
            
        </li>
        </ul>
        <button style="margin-left: 30;" class="btn btn-danger"><a style="text-decoration: none;" class= "text-light" href="logout.php">Logout</a></button>
        
          

       
        <?php else: ?>
          <?php 
            header("location:login.php");
            exit;
        endif;
        ?>
          

  </div>
</nav>
