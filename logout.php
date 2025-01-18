<?php
session_start();
session_destroy(); // Menghancurkan semua sesi
header('Location: index.php'); // Mengarahkan ke halaman login
exit();
?>
