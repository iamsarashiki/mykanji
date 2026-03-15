<?php
session_start();
include '../includes/functions.php';

if ($_POST['action'] == 'register') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $ip = $_SERVER['REMOTE_ADDR'];
    // Dapatkan kode negara dari IP (gunakan API atau library, di sini kita fallback)
    $flag = 'ID'; // default, nanti bisa pakai API
    $users = getUsers();
    if (isset($users[$username])) {
        echo 'Username sudah ada';
        exit;
    }
    $newUser = [
        'password' => $password,
        'ip' => $ip,
        'flag' => $flag,
        'level' => 1,
        'exp' => 0,
        'rank' => 'Warrior',
        'stars' => 0,
        'photo' => 'default.jpg',
        'cover' => 'default_cover.jpg'
    ];
    saveUser($username, $newUser);
    $_SESSION['user'] = $username;
    echo 'success';
}
?>
