<?php
 
session_start();

// Oturumu sonlandır
session_destroy();

 
header("Location: kayit.php");
exit();
?>