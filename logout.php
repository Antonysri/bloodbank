    <?php
    session_start();
    if(isset($_SESSION['hid']) || isset($_SESSION['rid'])){

        session_unset();
        session_destroy();

        header("location:index.php");
        exit;


    }




    ?>