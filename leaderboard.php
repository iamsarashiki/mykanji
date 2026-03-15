<?php
include 'includes/functions.php';
$users = getUsers();
// Urutkan berdasarkan exp descending
uasort($users, function($a, $b) {
    return $b['exp'] <=> $a['exp'];
});
$rank = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <h1>Leaderboard</h1>
    <table border="1">
        <tr>
            <th>Rank</th>
            <th>User</th>
            <th>Level</th>
            <th>Exp</th>
            <th>Rank Game</th>
            <th>Stars</th>
        </tr>
        <?php foreach ($users as $username => $data): ?>
        <tr>
            <td><?= $rank++ ?></td>
            <td><?= htmlspecialchars($username) ?></td>
            <td><?= $data['level'] ?></td>
            <td><?= $data['exp'] ?></td>
            <td><?= $data['rank'] ?></td>
            <td><?= $data['stars'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
