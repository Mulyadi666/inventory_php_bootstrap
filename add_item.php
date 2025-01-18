<?php
include('includes/header.php');
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO items (name, category_id, quantity, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $category_id, $quantity, $description]);

    header('Location: items.php');
}
?>

<div class="container mt-4">
    <h3>Tambah Barang</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <?php
                $categories = $conn->query("SELECT * FROM categories")->fetchAll();
                foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Stok</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
