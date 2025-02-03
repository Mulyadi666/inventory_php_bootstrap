<?php
include('includes/header.php');
include('includes/db.php');

// Proses pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil data barang beserta kategori dengan pencarian
$query = "SELECT items.*, categories.name AS category FROM items 
          JOIN categories ON items.category_id = categories.id";

if ($search) {
    $query .= " WHERE items.name LIKE :search OR categories.name LIKE :search";
}

$stmt = $conn->prepare($query);
if ($search) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
$stmt->execute();
$items = $stmt->fetchAll();

// Mengambil data kategori untuk dropdown kategori
$categories = $conn->query("SELECT * FROM categories")->fetchAll();
?>

<div class="container mt-4">
    <h3>Manajemen Barang</h3>
    <a href="add_item.php" class="btn btn-primary mb-3">Tambah Barang</a>
    <a href="manage_categories.php" class="btn btn-success mb-3">List Kategori</a>
    <a href="items_out.php" class="btn btn-warning mb-3">Barang Keluar</a>

    <!-- Form Pencarian -->
    <form method="GET" class="mb-3">
        <div class="input-group w-25">
            <input type="text" name="search" class="form-control"
                placeholder="Cari barang atau kategori..."
                value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <!-- Tabel Barang -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
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
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                            data-name="<?= $item['name'] ?>"
                            data-category="<?= $item['category'] ?>"
                            data-quantity="<?= $item['quantity'] ?>"
                            data-description="<?= $item['description'] ?>">
                            Detail
                        </button>
                        <a href="edit_item.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_item.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="modalName"></span></p>
                <p><strong>Kategori:</strong> <span id="modalCategory"></span></p>
                <p><strong>Stok:</strong> <span id="modalQuantity"></span></p>
                <p><strong>Deskripsi:</strong></p>
                <p id="modalDescription"></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk menangani klik tombol detail dan menampilkan data di modal
    document.addEventListener("DOMContentLoaded", function() {
        var detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            document.getElementById('modalName').textContent = button.getAttribute('data-name');
            document.getElementById('modalCategory').textContent = button.getAttribute('data-category');
            document.getElementById('modalQuantity').textContent = button.getAttribute('data-quantity');
            document.getElementById('modalDescription').textContent = button.getAttribute('data-description');
        });
    });
</script>

<?php include('includes/footer.php'); ?>