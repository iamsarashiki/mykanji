<?php
// Cek session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <div class="logo">KanjiLearn</div>
    <div class="nav-links">
        <a href="index.php" <?= $current_page == 'index.php' ? 'class="active"' : '' ?>>Home</a>
        <a href="kanji.php" <?= $current_page == 'kanji.php' ? 'active' : '' ?>>Kanji</a>
        <a href="quiz.php" <?= $current_page == 'quiz.php' ? 'active' : '' ?>>Quiz</a>
        <a href="quest.php" <?= $current_page == 'quest.php' ? 'active' : '' ?>>Quest</a>
        <a href="leaderboard.php" <?= $current_page == 'leaderboard.php' ? 'active' : '' ?>>Leaderboard</a>
        <a href="news.php" <?= $current_page == 'news.php' ? 'active' : '' ?>>Berita</a>
        <a href="chat.php" <?= $current_page == 'chat.php' ? 'active' : '' ?>>Chat Global</a>
        <a href="profile.php" <?= $current_page == 'profile.php' ? 'active' : '' ?>>Profil</a>
        <?php if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin'): ?>
            <a href="admin/index.php" <?= strpos($current_page, 'admin') !== false ? 'active' : '' ?>>Admin</a>
        <?php endif; ?>
    </div>
    <div class="theme-switch">
        <button onclick="toggleTheme()">🌓</button>
    </div>
    <div class="language-select">
        <select onchange="changeLanguage(this.value)">
            <option value="id">🇮🇩 Indonesia</option>
            <option value="jp">🇯🇵 Jepang</option>
            <option value="en">🇬🇧 Inggris</option>
        </select>
    </div>
    <?php if(isset($_SESSION['user'])): ?>
        <a href="api/logout.php" class="logout">Logout</a>
    <?php else: ?>
        <a href="login.php" class="login">Login</a>
    <?php endif; ?>
</nav>
