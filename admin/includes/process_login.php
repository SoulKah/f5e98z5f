<?php
include_once '_connect.php';
include_once '_functions.php';
 
ob_start();
session_start();
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: ../view.php');
        exit;
    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
        exit;
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}