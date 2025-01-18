<?php
include('includes/db.php');
session_start();

// Ambil ID kategori dari URL
$category_id = $_GET['id'];

// Ambil data kategori berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch();

if (!$category) {
    $_SESSION['error'] = "Kategori tidak ditemukan!";
    header('Location: manage_categories.php'); // Ganti ke halaman kategori utama jika ada
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    // Query untuk mengupdate data kategori
    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->execute([$category_name, $category_id]);

    $_SESSION['message'] = "Kategori berhasil diperbarui!";
    header('Location: manage_categories.php'); // Ganti ke halaman kategori utama jika ada
    exit;
}

$page_title = 'Edit Kategori';
include('includes/header.php');
?>

<div class="container mt-5">
    <h2>Edit Kategori</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="<?= $category['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Kategori</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
