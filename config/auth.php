<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../login.php');
        exit;
    }
}

if(!isset($_SESSION['id'])){

    header("Location: /SIGEP/login.php");

    exit;

}
?>
