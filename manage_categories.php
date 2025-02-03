<?php
include('includes/header.php');
include('includes/db.php');
session_start();

// Proses pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil kategori dengan filter pencarian
$query = "SELECT * FROM categories";
if ($search) {
    $query .= " WHERE name LIKE :search";
}

$stmt = $conn->prepare($query);
if ($search) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->execute();
$categories = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Manajemen Kategori</h2>
    <a href="items.php" class="btn btn-primary mb-3">Kembali ke Daftar Barang</a>
    <a href="add_categories.php" class="btn btn-success mb-3">Tambah Kategori</a>

    <!-- Form Pencarian -->
    <form method="GET" class="mb-3">
        <div class="input-group w-50">
            <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <?php if ($search): ?>
                <a href="manage_categories.php" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories) > 0): ?>
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
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada kategori yang ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php'); ?>