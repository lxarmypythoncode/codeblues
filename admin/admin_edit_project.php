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
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM projects WHERE id=$id");
    $project = $result->fetch_assoc();
}

if (isset($_POST['update_project'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Proses upload file
    $file = $project['file']; // Default to existing file
    if ($_FILES['file']['name']) {
        $target_dir = "uploads/projects/";
        $target_file = $target_dir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $file = basename($_FILES['file']['name']);

            // Hapus file lama
            if (file_exists($target_dir . $project['file'])) {
                unlink($target_dir . $project['file']);
            }
        }
    }

    // Update proyek
    $stmt = $conn->prepare("UPDATE projects SET name = ?, description = ?, file = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $description, $file, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo htmlspecialchars($project['name']); ?>" required>
    <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>
    <input type="file" name="file" accept=".docx,.pdf,.zip,.rar">
    <button type="submit" name="update_project">Update Project</button>
</form>
