<?php
session_start();
include '../includes/functions.php';
if (!isset($_SESSION['user']) || !isAdmin($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$chatFile = '../data/chat.txt';
$chat = file_exists($chatFile) ? file($chatFile, FILE_IGNORE_NEW_LINES) : [];

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if (isset($chat[$id])) {
        unset($chat[$id]);
        file_put_contents($chatFile, implode("\n", $chat));
    }
    header('Location: manage_chat.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Chat</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Kelola Chat Global</h1>
    <table border="1">
        <tr><th>Waktu</th><th>User</th><th>Pesan</th><th>Aksi</th></tr>
        <?php foreach ($chat as $index => $line): 
            $parts = explode('|', $line);
            if (count($parts) >= 3):
        ?>
        <tr>
            <td><?= date('d-m-Y H:i', $parts[0]) ?></td>
            <td><?= htmlspecialchars($parts[1]) ?></td>
            <td><?= htmlspecialchars($parts[2]) ?></td>
            <td><a href="?delete=<?= $index ?>" onclick="return confirm('Hapus pesan ini?')">Hapus</a></td>
        </tr>
        <?php endif; endforeach; ?>
    </table>
    <a href="index.php">Kembali</a>
</body>
</html>
