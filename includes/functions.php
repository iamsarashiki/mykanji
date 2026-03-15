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

// Fungsi untuk update level dan rank berdasarkan penambahan exp
function updateLevelExp($username, $expGain) {
    $users = getUsers();
    if (!isset($users[$username])) return false;
    $user = $users[$username];
    $user['exp'] += $expGain;
    $exp = $user['exp'];
    // Level = floor(exp/100) + 1
    $user['level'] = floor($exp / 100) + 1;
    // Rank
    if ($exp < 100) {
        $user['rank'] = 'Warrior';
        $user['stars'] = 0;
    } elseif ($exp < 300) {
        $user['rank'] = 'Elite';
        $user['stars'] = 0;
    } elseif ($exp < 600) {
        $user['rank'] = 'Master';
        $user['stars'] = 0;
    } elseif ($exp < 1000) {
        $user['rank'] = 'Grandmaster';
        $user['stars'] = 0;
    } elseif ($exp < 1500) {
        $user['rank'] = 'Epic';
        $user['stars'] = 0;
    } elseif ($exp < 2000) {
        $user['rank'] = 'Legend';
        $user['stars'] = 0;
    } elseif ($exp < 3000) {
        $user['rank'] = 'Mythic';
        $user['stars'] = 0;
    } else {
        $user['rank'] = 'Mythical Glory';
        $user['stars'] = floor(($exp - 3000) / 200) + 1;
        if ($user['stars'] > 5000) $user['stars'] = 5000;
    }
    $users[$username] = $user;
    saveUser($username, $user);
    return true;
}
?>
