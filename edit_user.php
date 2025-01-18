<?php
session_start();
include('includes/db.php');

// Pastikan pengguna sudah login dan adalah admin
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user || $user['role'] != 'admin') {
    header('Location: dashboard.php'); // Arahkan ke dashboard jika bukan admin
    exit();
}

if (isset($_GET['id'])) {
    $edit_user_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$edit_user_id]);
    $edit_user = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $edit_user['password'];
    $role = $_POST['role'];

    // Mengupdate user
    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
    $stmt->execute([$username, $password, $role, $edit_user_id]);

    $success = "User updated successfully!";
}

$page_title = 'Edit User';
include('includes/header.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">Edit User</div>
                <div class="card-body">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($edit_user['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="admin" <?= $edit_user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= $edit_user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
