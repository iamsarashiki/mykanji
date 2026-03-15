<?php
session_start();
include '../includes/functions.php';
if (!isAdmin($_SESSION['user'])) {
    header('Location: ../login.html');
    exit;
}
?>
<h1>Admin Dashboard</h1>
<ul>
    <li><a href="manage_news.php">Kelola Berita</a></li>
    <li><a href="manage_users.php">Kelola Pengguna</a></li>
    <li><a href="manage_chat.php">Kelola Chat</a></li>
</ul>
