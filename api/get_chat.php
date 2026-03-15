<?php
$chat = file('../data/chat.txt', FILE_IGNORE_NEW_LINES);
$chat = array_reverse($chat);
foreach ($chat as $c) {
    $parts = explode('|', $c);
    if (count($parts) >= 3) {
        echo "<p><strong>{$parts[1]}</strong> ({$parts[0]}): {$parts[2]}</p>";
    }
}
?>
