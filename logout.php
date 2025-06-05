<?php
$title = "Log Out | Imran_Store";
session_start();
session_unset();
header("Location: index.php");
?>

<h1>Log Out</h1>