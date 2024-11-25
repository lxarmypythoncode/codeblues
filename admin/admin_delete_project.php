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
    
    // Hapus proyek dari database
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Hapus file terkait jika ada
    $stmt = $conn->prepare("SELECT file FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && file_exists('uploads/projects/' . $row['file'])) {
        unlink('uploads/projects/' . $row['file']);
    }

    header("Location: admin_dashboard.php");
    exit;
}
?>
