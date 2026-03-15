<?php
include '../includes/functions.php';
$users = getUsers();
uasort($users, function($a, $b) {
    return $b['exp'] <=> $a['exp'];
});
$rank = 1;
$output = [];
foreach ($users as $username => $data) {
    $output[] = [
        'rank' => $rank++,
        'username' => $username,
        'level' => $data['level'],
        'exp' => $data['exp'],
        'rank_game' => $data['rank'],
        'stars' => $data['stars']
    ];
}
header('Content-Type: application/json');
echo json_encode($output);
?>
