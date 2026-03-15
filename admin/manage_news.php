<?php
session_start();
include '../includes/functions.php';
if (!isAdmin($_SESSION['user'])) exit;

if ($_POST['action'] == 'add') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    // Upload gambar
    $gambar = '';
    if ($_FILES['gambar']['name']) {
        $gambar = 'uploads/' . time() . '_' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../' . $gambar);
    }
    $video = $_POST['video']; // URL video
    $waktu = time();
    $penulis = $_SESSION['user'];
    $id = uniqid();
    $line = "$id|$judul|$konten|$gambar|$video|$waktu|$penulis\n";
    file_put_contents('../data/news.txt', $line, FILE_APPEND);
    header('Location: manage_news.php');
}

// Tampilkan form dan daftar berita
?>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add">
    Judul: <input type="text" name="judul"><br>
    Konten: <textarea name="konten"></textarea><br>
    Gambar: <input type="file" name="gambar"><br>
    Video URL: <input type="text" name="video"><br>
    <button type="submit">Tambah Berita</button>
</form>
<hr>
<?php
$news = file('../data/news.txt', FILE_IGNORE_NEW_LINES);
foreach ($news as $item) {
    $parts = explode('|', $item);
    echo "<div><h3>{$parts[1]}</h3><p>{$parts[2]}</p>";
    if ($parts[3]) echo "<img src='../{$parts[3]}' width='200'>";
    if ($parts[4]) echo "<a href='{$parts[4]}'>Video</a>";
    echo "<a href='?delete={$parts[0]}'>Hapus</a></div>";
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $new = array_filter($news, function($line) use ($id) {
        return strpos($line, $id) !== 0;
    });
    file_put_contents('../data/news.txt', implode("\n", $new));
    header('Location: manage_news.php');
}
?>
