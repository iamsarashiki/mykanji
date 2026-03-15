<?php
session_start();
include '../includes/functions.php';
if (!isset($_SESSION['user'])) exit;
$user = $_SESSION['user'];
if ($_FILES['photo']['name']) {
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $filename = $user . '.' . $ext;
    move_uploaded_file($_FILES['photo']['tmp_name'], '../photo/' . $filename);
    // Update users.txt
    $users = getUsers();
    $users[$user]['photo'] = $filename;
    saveUser($user, $users[$user]);
    echo 'ok';
}
?>
