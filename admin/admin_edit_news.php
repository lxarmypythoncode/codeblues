<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codeblues";
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM news WHERE id=$id");
    $news = $result->fetch_assoc();
}

if (isset($_POST['update_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];

    $sql = "UPDATE news SET title='$title', content='$content', image='$image' WHERE id=$id";
    $conn->query($sql);

    header("Location: admin_dashboard.php");
    exit;
}
?>

<form method="POST">
    <input type="text" name="title" value="<?php echo $news['title']; ?>" required>
    <textarea name="content" required><?php echo $news['content']; ?></textarea>
    <input type="text" name="image" value="<?php echo $news['image']; ?>">
    <button type="submit" name="update_news">Update Berita</button>
</form>
