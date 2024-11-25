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
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses tambah berita
if (isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Proses upload gambar
    $image = "";
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/news/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $target_file;
        }
    }

    // Simpan ke database
    $sql = "INSERT INTO news (title, content, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $content, $image);
    $stmt->execute();
}

// Proses tambah proyek
if (isset($_POST['add_project'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Proses upload file
    $file = "";
    if ($_FILES['file']['name']) {
        $target_dir = "uploads/projects/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $file = basename($_FILES['file']['name']);
        }
    }

    // Simpan ke database
    $sql = "INSERT INTO projects (name, description, file) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $file);
    $stmt->execute();
}

// Menampilkan semua data berita dan proyek
$news = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #00ff00;
            background-color: #000000;
            margin: 0;
            padding: 0;
        }
        h2, h3 {
            color: #00ff00;
            text-shadow: 0 0 10px #00ff00;
        }
        form {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            margin-bottom: 20px;
        }
        input[type="text"], textarea, input[type="file"], button {
            border: none;
            padding: 10px;
            margin: 5px 0;
            background-color: #333;
            color: #00ff00;
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(0, 255, 0, 0.3);
        }
        button {
            cursor: pointer;
            background-color: #00ff00;
            color: #000;
        }
        button:hover {
            background-color: #00cc00;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            border-bottom: 1px solid #333;
            padding: 10px 0;
        }
        img {
            max-width: 100px;
            border: 1px solid #333;
        }
        a {
            color: #00ff00;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .animated-input {
            position: relative;
            overflow: hidden;
        }
        .animated-input:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #00ff00;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .animated-input:focus-within:after {
            transform: translateX(0);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inputs = document.querySelectorAll('input[type="text"], textarea');
            inputs.forEach(function (input) {
                input.addEventListener('focus', function () {
                    this.parentElement.classList.add('focused');
                });
                input.addEventListener('blur', function () {
                    this.parentElement.classList.remove('focused');
                });
            });
        });
    </script>
</head>
<body>
    <h2>Dashboard Admin</h2>

    <!-- Tambah Berita -->
    <h3>Tambah Berita</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="animated-input">
            <input type="text" name="title" placeholder="Judul Berita" required>
        </div>
        <div class="animated-input">
            <textarea name="content" placeholder="Isi Berita" required></textarea>
        </div>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="add_news">Tambah Berita</button>
    </form>

    <!-- Tambah Proyek -->
    <h3>Tambah Proyek</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="animated-input">
            <input type="text" name="name" placeholder="Nama Proyek" required>
        </div>
        <div class="animated-input">
            <textarea name="description" placeholder="Deskripsi Proyek" required></textarea>
        </div>
        <input type="file" name="file" accept=".docx,.pdf,.zip,.rar">
        <button type="submit" name="add_project">Tambah Proyek</button>
    </form>

    <hr>

    <!-- List Berita -->
    <h3>List Berita</h3>
    <ul>
        <?php while ($row = $news->fetch_assoc()): ?>
            <li>
                <strong><?php echo htmlspecialchars($row['title']); ?> (<?php echo htmlspecialchars($row['created_at']); ?>)</strong>
                <p><?php echo htmlspecialchars($row['content']); ?></p>
                <?php if ($row['image']): ?>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Gambar Berita">
                <?php endif; ?>
                <a href="admin_edit_news.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="admin_delete_news.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- List Proyek -->
    <h3>List Proyek</h3>
    <ul>
        <?php while ($row = $projects->fetch_assoc()): ?>
            <li>
                <strong><?php echo htmlspecialchars($row['name']); ?> (<?php echo htmlspecialchars($row['created_at']); ?>)</strong>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <?php if ($row['file']): ?>
                    <?php $filePath = 'uploads/projects/' . htmlspecialchars($row['file']); ?>
                    <?php if (strpos($row['file'], '.pdf') !== false): ?>
                        <a href="<?php echo $filePath; ?>" target="_blank">View Document</a>
                    <?php elseif (strpos($row['file'], '.docx') !== false): ?>
                        <a href="<?php echo $filePath; ?>" target="_blank">View Document</a>
                    <?php elseif (strpos($row['file'], '.zip') !== false || strpos($row['file'], '.rar') !== false): ?>
                        <a href="<?php echo $filePath; ?>" target="_blank">Download File</a>
                    <?php endif; ?>
                <?php endif; ?>
                <a href="admin_edit_project.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                <a href="admin_delete_project.php?id=<?php echo $row['id']; ?>">Hapus</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="admin_logout.php">Logout</a>
</body>
</html>

<?php
$conn->close();
?>
