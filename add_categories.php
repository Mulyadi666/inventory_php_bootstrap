<?php
include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    // Query untuk menambah kategori baru
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$category_name]);

    $_SESSION['message'] = "Kategori berhasil ditambahkan!";
    header('Location: manage_categories.php'); // Ganti ke halaman kategori utama jika ada
    exit;
}

$page_title = 'Tambah Kategori';
include('includes/header.php');
?>

<div class="container mt-5">
    <h2>Tambah Kategori Baru</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah Kategori</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
