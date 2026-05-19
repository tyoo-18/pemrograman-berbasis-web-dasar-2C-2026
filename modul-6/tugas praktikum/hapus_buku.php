<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

$query = $conn->prepare("DELETE FROM buku WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

header("Location: dashboard.php");
exit;
