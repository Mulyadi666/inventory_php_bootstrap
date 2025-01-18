<?php
session_start();
include('includes/db.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Jika pengguna tidak ditemukan, arahkan ke login
if (!$user) {
    header('Location: login.php');
    exit();
}

$page_title = 'Profile';
include('includes/header.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">User Profile</div>
                <div class="card-body">
                    <h5>Username: <?= htmlspecialchars($user['username']) ?></h5>
                    <p>ID: <?= htmlspecialchars($user['id']) ?></p>
                    <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
