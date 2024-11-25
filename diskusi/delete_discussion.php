<?php
session_start(); // Pastikan pengguna sudah login

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'codeblues');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID diskusi dari POST
$discussion_id = isset($_POST['discussion_id']) ? intval($_POST['discussion_id']) : 0;

// Hapus komentar terkait
$delete_comments_sql = "DELETE FROM comments WHERE discussion_id = ?";
$stmt = $conn->prepare($delete_comments_sql);
$stmt->bind_param('i', $discussion_id);
$stmt->execute();

// Hapus diskusi
$delete_discussion_sql = "DELETE FROM discussions WHERE id = ?";
$stmt = $conn->prepare($delete_discussion_sql);
$stmt->bind_param('i', $discussion_id);
$stmt->execute();

header("Location: html_discussion.php"); // Redirect kembali ke halaman diskusi
exit;

// Tutup koneksi
$conn->close();
?>
