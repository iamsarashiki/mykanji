<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "not logged in";
    exit;
}
$user = $_SESSION['user'];
$level = $_POST['level']; // n5 atau n4
$answers = $_POST['answers']; // array jawaban user

// Load soal
$quizFile = "../data/quiz_$level.txt";
$soal = file($quizFile, FILE_IGNORE_NEW_LINES);
$benar = 0;
foreach ($soal as $index => $line) {
    $parts = explode('|', $line);
    $jawabanBenar = $parts[5]; // index jawaban
    if (isset($answers[$index]) && $answers[$index] == $jawabanBenar) {
        $benar++;
    }
}
$total = count($soal);
$score = $benar; // jumlah benar

// Tambah exp berdasarkan jumlah benar
include '../includes/functions.php';
updateLevelExp($user, $benar * 5); // 5 exp per soal benar

echo "Anda benar $benar dari $total soal. Exp + " . ($benar*5);
?>
