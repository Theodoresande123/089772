<?php
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../index.php");
}
$login = $_SESSION['loggin'] ?? "";
// die(header("Location: ../index.php"));