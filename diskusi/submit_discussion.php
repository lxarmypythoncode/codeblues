<?php
session_start(); // Pastikan pengguna sudah login

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'codeblues');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil username dari session
$username = $_SESSION['username']; // Ambil username dari session

// Ambil data dari form
$discussion_text = $_POST['discussion'];

// Masukkan diskusi ke dalam database
$sql = "INSERT INTO discussions (username, discussion_text, discussion_type) VALUES ('$username', '$discussion_text', 'HTML')";

if ($conn->query($sql) === TRUE) {
    header("Location: html_discussion.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
