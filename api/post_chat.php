<?php
session_start();
include '../includes/functions.php';
if (!isset($_SESSION['user'])) exit;
$user = $_SESSION['user'];
// Cek mute
$muted = file('../data/muted.txt', FILE_IGNORE_NEW_LINES);
if (in_array($user, $muted)) {
    echo 'muted';
    exit;
}
$msg = $_POST['message'];
$time = time();
$line = "$time|$user|$msg\n";
file_put_contents('../data/chat.txt', $line, FILE_APPEND);
echo 'ok';
?>
