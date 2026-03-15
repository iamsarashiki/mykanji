<?php
function getUsers() {
    $file = '../data/users.txt';
    $users = [];
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            if (count($parts) >= 10) {
                $users[$parts[0]] = [
                    'password' => $parts[1],
                    'ip' => $parts[2],
                    'flag' => $parts[3],
                    'level' => $parts[4],
                    'exp' => $parts[5],
                    'rank' => $parts[6],
                    'stars' => $parts[7],
                    'photo' => $parts[8],
                    'cover' => $parts[9]
                ];
            }
        }
    }
    return $users;
}

function saveUser($username, $data) {
    $file = '../data/users.txt';
    $users = getUsers();
    $users[$username] = $data;
    $lines = [];
    foreach ($users as $u => $d) {
        $lines[] = implode('|', [$u, $d['password'], $d['ip'], $d['flag'], $d['level'], $d['exp'], $d['rank'], $d['stars'], $d['photo'], $d['cover']]);
    }
    file_put_contents($file, implode("\n", $lines));
}

function isAdmin($username) {
    // Sederhana: cek apakah username 'admin' atau bisa ditambahkan flag di users.txt
    return $username === 'admin';
}
?>
