<?php session_start(); if(isset($_SESSION['user'])) header('Location: dashboard.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="character">
                <img src="assets/images/anime-girl.png" alt="Anime">
                <p>Daftar yuk! (◕‿◕)</p>
            </div>
            <div class="form">
                <h2>Register</h2>
                <form id="registerForm">
                    <input type="text" id="username" placeholder="Username" required><br>
                    <input type="password" id="password" placeholder="Password" required><br>
                    <button type="submit">Daftar</button>
                </form>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'register');
            formData.append('username', document.getElementById('username').value);
            formData.append('password', document.getElementById('password').value);
            const res = await fetch('api/register.php', { method: 'POST', body: formData });
            const text = await res.text();
            if (text === 'success') {
                window.location.href = 'dashboard.php';
            } else {
                alert(text);
            }
        });
    </script>
</body>
</html>
