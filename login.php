<?php session_start(); if(isset($_SESSION['user'])) header('Location: dashboard.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="character">
                <img src="assets/images/anime-girl.png" alt="Anime">
                <p>Hai! Ayo login! ฅ^•ﻌ•^ฅ</p>
            </div>
            <div class="form">
                <h2>Login</h2>
                <div class="flag-selector" id="flag-selector"></div>
                <form id="loginForm">
                    <input type="text" id="username" placeholder="Username" required><br>
                    <input type="password" id="password" placeholder="Password" required><br>
                    <button type="submit">Login</button>
                </form>
                <p>Belum punya akun? <a href="register.php">Daftar</a></p>
            </div>
        </div>
    </div>
    <script>
        fetch('https://ipapi.co/json/')
            .then(res => res.json())
            .then(data => {
                const countryCode = data.country_code || 'ID';
                document.getElementById('flag-selector').innerHTML = `<img src="https://flagcdn.com/${countryCode.toLowerCase()}.svg" class="selected" title="${data.country_name}">`;
            })
            .catch(() => {
                document.getElementById('flag-selector').innerHTML = '<img src="https://flagcdn.com/id.svg" class="selected" title="Indonesia">';
            });

        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'login');
            formData.append('username', document.getElementById('username').value);
            formData.append('password', document.getElementById('password').value);
            const res = await fetch('api/login.php', { method: 'POST', body: formData });
            const text = await res.text();
            if (text === 'success') {
                window.location.href = 'dashboard.php';
            } else {
                alert('Login gagal: ' + text);
            }
        });
    </script>
</body>
</html>
