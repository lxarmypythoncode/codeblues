<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'codeblues');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$reply = $_POST['reply'];
$discussion_id = $_POST['discussion_id'];
$redirect_page = $_POST['redirect_page'];
$username = 'guest'; // Ganti dengan nama pengguna yang sesuai

// Insert komentar
$stmt = $conn->prepare("INSERT INTO comments (discussion_id, comment_text, username) VALUES (?, ?, ?)");
$stmt->bind_param('iss', $discussion_id, $reply, $username);
$stmt->execute();
$stmt->close();

// Redirect ke halaman yang sama
header("Location: " . htmlspecialchars($redirect_page) . "?discussion_id=" . urlencode($discussion_id));
exit;
?>
