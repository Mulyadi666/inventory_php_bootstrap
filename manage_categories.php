<?php
include('includes/header.php');
include('includes/db.php');
session_start();

// Ambil semua kategori dari database
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<div class="container mt-5">
    <h2>Manajemen Kategori</h2>
    <a href="add_categories.php" class="btn btn-success mb-3">Tambah Kategori</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $index => $category): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $category['name'] ?></td>
                    <td>
                        <a href="edit_categories.php?id=<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_categories.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
