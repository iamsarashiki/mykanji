<?php
session_start();
include '../includes/functions.php';
if (!isset($_SESSION['user']) || !isAdmin($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <ul>
        <li><a href="manage_news.php">Kelola Berita</a></li>
        <li><a href="manage_users.php">Kelola Pengguna</a></li>
        <li><a href="manage_chat.php">Kelola Chat</a></li>
    </ul>
    <a href="../dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
