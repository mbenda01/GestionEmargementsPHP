<?php
session_start();
session_destroy();
header("Location: /projetEmargementsPHP/pages/auth/login.php");
exit;
?>
