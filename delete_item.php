<?php
include('includes/db.php');
session_start();

// Ambil ID dari URL
$item_id = $_GET['id'];

// Query untuk menghapus item dari database
$stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
$stmt->execute([$item_id]);

$_SESSION['message'] = "Item berhasil dihapus!";
header('Location: items.php');
exit;
?>
