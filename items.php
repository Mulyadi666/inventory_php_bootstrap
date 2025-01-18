<?php
include('includes/header.php');
include('includes/db.php');

// Mengambil data barang beserta kategori
$items = $conn->query("SELECT items.*, categories.name AS category FROM items JOIN categories ON items.category_id = categories.id")->fetchAll();

// Mengambil data kategori untuk dropdown kategori
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<div class="container mt-4">
    <h3>Manajemen Barang</h3>
    <a href="add_item.php" class="btn btn-primary mb-3">Tambah Barang</a>
    <a href="manage_categories.php" class="btn btn-success mb-3">List Kategori</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['category'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td>
                        <a href="edit_item.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_item.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>
