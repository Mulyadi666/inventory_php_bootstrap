<?php
include('includes/header.php');
include('includes/db.php');
session_start();

// Ambil daftar barang untuk dropdown
$items = $conn->query("SELECT * FROM items ORDER BY name ASC")->fetchAll();

// Ambil daftar barang keluar
$items_out = $conn->query("SELECT items_out.*, items.name FROM items_out JOIN items ON items_out.item_id = items.id ORDER BY items_out.id DESC")->fetchAll();
?>

<div class="container mt-5">
    <h2>Barang Keluar</h2>

    <!-- Alert Notifikasi -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
    <?php endif; ?>

    <!-- Tombol Tambah Barang Keluar -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#itemsOutModal">Tambah Barang Keluar</button>

    <!-- Tabel Data Barang Keluar -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Jumlah Keluar</th>
                <th>Catatan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items_out as $index => $out): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($out['name']) ?></td>
                    <td><?= $out['quantity_out'] ?></td>
                    <td><?= htmlspecialchars($out['notes']) ?></td>
                    <td><?= $out['date_out'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="itemsOutModal" tabindex="-1" aria-labelledby="itemsOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemsOutModalLabel">Tambah Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="process_items_out.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="item_id" class="form-label">Pilih Barang</label>
                        <select name="item_id" id="item_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?> (Stok: <?= $item['quantity'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity_out" class="form-label">Jumlah Keluar</label>
                        <input type="number" name="quantity_out" id="quantity_out" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>