<?php
session_start();
if (!isset($_SESSION['user'])) exit;
$user = $_SESSION['user'];
$questId = $_POST['quest_id'];
$progress = $_POST['progress']; // misal 1

// Simpan progress quest di file terpisah per user
$questFile = "../data/quest_$user.txt";
$data = [];
if (file_exists($questFile)) {
    $lines = file($questFile, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $parts = explode('|', $line);
        $data[$parts[0]] = $parts[1];
    }
}
if (!isset($data[$questId])) {
    $data[$questId] = 0;
}
$data[$questId] += $progress;
// Cek apakah quest selesai? Misal target 1
if ($data[$questId] >= 1) {
    // Beri exp, dll
    include '../includes/functions.php';
    updateLevelExp($user, 50);
    // Tandai selesai
    $data[$questId] = 'completed';
}
// Simpan kembali
$out = [];
foreach ($data as $id => $val) {
    $out[] = "$id|$val";
}
file_put_contents($questFile, implode("\n", $out));
echo "ok";
?>
