<?php
session_start();
include('includes/db.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$page_title = 'Reports';
include('includes/header.php');

// Ambil data dari tabel inventory
$stmt = $conn->prepare("SELECT * FROM inventory");
$stmt->execute();
$inventory = $stmt->fetchAll();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">Inventory Reports</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($inventory as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['item_name']) ?></td>
                                    <td><?= htmlspecialchars($item['stock']) ?></td>
                                    <td><?= htmlspecialchars($item['price']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
