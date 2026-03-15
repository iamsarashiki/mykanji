<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include 'includes/functions.php';
$user = $_SESSION['user'];
$users = getUsers();
$data = $users[$user];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
        <h1>Selamat datang, <?= htmlspecialchars($user) ?>!</h1>
        <div class="user-info">
            <p><strong>Level:</strong> <?= $data['level'] ?></p>
            <p><strong>Exp:</strong> <?= $data['exp'] ?></p>
            <p><strong>Rank:</strong> <?= $data['rank'] ?> <?= $data['stars'] > 0 ? "($data[stars]⭐)" : '' ?></p>
        </div>
        <!-- Sidebar foto nanti -->
    </div>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/language.js"></script>
</body>
</html>
