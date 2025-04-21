<?php
session_start();
session_unset();
header("Location: index.php");
?>

<h1>Logout</h1>