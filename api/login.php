<?php
session_start();
include '../includes/functions.php';

if ($_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = getUsers();
    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['user'] = $username;
        echo 'success';
    } else {
        echo 'Username atau password salah';
    }
}
?>
