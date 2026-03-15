<?php
$level = $_GET['level']; // n5 atau n4
$file = "../data/kanji_$level.txt";
if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}
$lines = file($file, FILE_IGNORE_NEW_LINES);
$data = [];
foreach ($lines as $line) {
    $parts = explode('|', $line);
    $data[] = [
        'kanji' => $parts[0],
        'baca' => $parts[1],
        'contoh' => $parts[2],
        'arti' => $parts[3]
    ];
}
echo json_encode($data);
?>
