<?php
include('includes/db.php');
session_start(); // Gunakan session untuk menyimpan pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $quantity_out = $_POST['quantity_out'];
    $notes = $_POST['notes'];

    // Ambil stok saat ini
    $stmt = $conn->prepare("SELECT quantity FROM items WHERE id = :item_id");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $item = $stmt->fetch();

    if ($item) {
        if ($item['quantity'] >= $quantity_out) {
            // Kurangi stok barang
            $updateStock = $conn->prepare("UPDATE items SET quantity = quantity - :quantity_out WHERE id = :item_id");
            $updateStock->bindParam(':quantity_out', $quantity_out);
            $updateStock->bindParam(':item_id', $item_id);
            $updateStock->execute();

            // Simpan data barang keluar
            $insertOut = $conn->prepare("INSERT INTO items_out (item_id, quantity_out, notes) VALUES (:item_id, :quantity_out, :notes)");
            $insertOut->bindParam(':item_id', $item_id);
            $insertOut->bindParam(':quantity_out', $quantity_out);
            $insertOut->bindParam(':notes', $notes);
            $insertOut->execute();

            $_SESSION['message'] = "Barang keluar berhasil dicatat!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Stok tidak mencukupi! Stok tersedia: " . $item['quantity'];
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Barang tidak ditemukan!";
        $_SESSION['message_type'] = "error";
    }
}

// Kembali ke halaman sebelumnya
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
