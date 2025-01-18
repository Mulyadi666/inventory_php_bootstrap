<?php
include('includes/db.php');
session_start();

// Ambil ID dari URL
$item_id = $_GET['id'];

// Ambil data item berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    // Query untuk mengupdate data item
    $stmt = $conn->prepare("UPDATE items SET name = ?, category_id = ?, quantity = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $category_id, $quantity, $description, $item_id]);

    $_SESSION['message'] = "Item berhasil diperbarui!";
    header('Location: items.php');
    exit;
}

// Ambil semua kategori untuk dropdown
$categories = $conn->query("SELECT * FROM categories")->fetchAll();

$page_title = 'Edit Item';
include('includes/header.php');
?>

<div class="container mt-5">
    <h2>Edit Item</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Item</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $item['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $item['category_id'] == $category['id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $item['quantity'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required><?= $item['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Item</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
