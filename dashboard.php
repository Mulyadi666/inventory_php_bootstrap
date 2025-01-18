<?php
include('includes/header.php');
include('includes/db.php');

$total_items = $conn->query("SELECT COUNT(*) FROM items")->fetchColumn();
$total_categories = $conn->query("SELECT COUNT(*) FROM categories")->fetchColumn();
?>

<div class="container mt-4">
    <h3>Dashboard</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Barang</h5>
                    <p><?= $total_items ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <p><?= $total_categories ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
