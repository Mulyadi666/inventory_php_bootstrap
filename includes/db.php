<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=inventory_db','root','');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $th) {
    //throw $th;
    die("Database connection failed " . $e->getMessage());
}