<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include 'includes/functions.php';
$user = $_SESSION['user'];
// Ambil quest dari file (anda perlu membuat sistem quest)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quest</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <h1>Quest Kanji</h1>
    <p>Fitur quest sedang dalam pengembangan.</p>
</body>
</html>
