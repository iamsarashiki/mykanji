<?php
session_start();
include '../includes/functions.php';
if (!isset($_SESSION['user']) || !isAdmin($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$users = getUsers();

if (isset($_GET['block'])) {
    $blockUser = $_GET['block'];
    $blocked = file('../data/blocked.txt', FILE_IGNORE_NEW_LINES);
    if (!in_array($blockUser, $blocked)) {
        file_put_contents('../data/blocked.txt', $blockUser . "\n", FILE_APPEND);
    }
    header('Location: manage_users.php');
}
if (isset($_GET['unblock'])) {
    $unblockUser = $_GET['unblock'];
    $blocked = file('../data/blocked.txt', FILE_IGNORE_NEW_LINES);
    $blocked = array_filter($blocked, function($b) use ($unblockUser) {
        return $b !== $unblockUser;
    });
    file_put_contents('../data/blocked.txt', implode("\n", $blocked));
    header('Location: manage_users.php');
}
if (isset($_GET['mute'])) {
    $muteUser = $_GET['mute'];
    $muted = file('../data/muted.txt', FILE_IGNORE_NEW_LINES);
    if (!in_array($muteUser, $muted)) {
        file_put_contents('../data/muted.txt', $muteUser . "\n", FILE_APPEND);
    }
    header('Location: manage_users.php');
}
if (isset($_GET['unmute'])) {
    $unmuteUser = $_GET['unmute'];
    $muted = file('../data/muted.txt', FILE_IGNORE_NEW_LINES);
    $muted = array_filter($muted, function($m) use ($unmuteUser) {
        return $m !== $unmuteUser;
    });
    file_put_contents('../data/muted.txt', implode("\n", $muted));
    header('Location: manage_users.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Manajemen Pengguna</h1>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>IP</th>
            <th>Level</th>
            <th>Exp</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $username => $data): ?>
        <tr>
            <td><?= htmlspecialchars($username) ?></td>
            <td><?= $data['ip'] ?></td>
            <td><?= $data['level'] ?></td>
            <td><?= $data['exp'] ?></td>
            <td>
                <a href="?block=<?= urlencode($username) ?>">Block</a> |
                <a href="?unblock=<?= urlencode($username) ?>">Unblock</a> |
                <a href="?mute=<?= urlencode($username) ?>">Mute</a> |
                <a href="?unmute=<?= urlencode($username) ?>">Unmute</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Kembali ke Admin Dashboard</a>
</body>
</html>
