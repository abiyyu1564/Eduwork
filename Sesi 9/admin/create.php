<?php
include '../koneksi.php';
// ensure products table is available
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

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_produk'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $stok = $_POST['stok'] ?? 0;
    $kategori = $_POST['kategori'] ?? '';
    $gambarName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['image']['tmp_name'];
        // generate unique name to avoid collisions
        $gambarName = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($tmp, '../img/' . $gambarName);
    }

    $stmt = $conn->prepare("INSERT INTO products (nama_produk, harga, deskripsi, stok, kategori, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sisiss', $nama, $harga, $deskripsi, $stok, $kategori, $gambarName);
    $stmt->execute();

    header('Location: index.php?status=created');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../components/navbar.php'; ?>

    <div class="max-w-lg mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Tambah Produk Baru</h1>
        <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block mb-1">Nama Produk</label>
                <input type="text" name="nama_produk" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Harga</label>
                <input type="number" name="harga" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div>
                <label class="block mb-1">Stok</label>
                <input type="number" name="stok" value="0" class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Kategori</label>
                <input type="text" name="kategori" class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Gambar</label>
                <input type="file" name="image" accept="image/*" class="w-full" />
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="index.php" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
