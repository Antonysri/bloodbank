
    <?php



if (isset($_SESSION['last-activity']) && (time() - $_SESSION['last-activity'] > 1800)) {
    // Clear session variables
    $_SESSION = array();
    session_unset();

    // Destroy the session
    session_destroy();
    header("location:login.php");
}

// Update session
$_SESSION['last-activity'] = time();

?>
