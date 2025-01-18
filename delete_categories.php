<?php
include('includes/db.php');
session_start();

// Ambil ID kategori dari URL
$category_id = $_GET['id'];

// Query untuk menghapus kategori
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$category_id]);

$_SESSION['message'] = "Kategori berhasil dihapus!";
header('Location: manage_categories.php'); // Ganti ke halaman kategori utama jika ada
exit;
?>
