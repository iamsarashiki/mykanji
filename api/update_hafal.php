<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "not logged in";
    exit;
}
$user = $_SESSION['user'];
$kanji = $_POST['kanji'];
$level = $_POST['level']; // n5 atau n4

$file = "../data/user_kanji_$user.txt";
$hafal = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
if (!in_array($kanji, $hafal)) {
    $hafal[] = $kanji;
    file_put_contents($file, implode("\n", $hafal));
    // Tambah exp
    include '../includes/functions.php';
    updateLevelExp($user, 10);
    echo "ok";
} else {
    echo "already";
}
?>
