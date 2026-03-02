<?php
include '../koneksi.php';
// ensure products table exists in case it's first run
$check = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    harga INT DEFAULT 0,
    deskripsi TEXT,
    stok INT DEFAULT 0,
    kategori VARCHAR(100) DEFAULT '',
    image VARCHAR(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($conn, $check);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    // fetch image filename first
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    if ($gambar && is_file('../img/' . $gambar)) {
        unlink('../img/' . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: index.php?status=deleted');
exit;
