<?php
include '../koneksi.php';
// ensure products table exists (should already be created by index/create)
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

// fetch existing data
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$nama = '';
$harga = '';
$deskripsi = '';
$stok = 0;
$kategori = '';
$oldGambar = '';

if ($id) {
    $stmt = $conn->prepare("SELECT nama_produk, harga, deskripsi, stok, kategori, image FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($nama, $harga, $deskripsi, $stok, $kategori, $oldGambar);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_produk'] ?? '';
    $harga = $_POST['harga'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $stok = $_POST['stok'] ?? 0;
    $kategori = $_POST['kategori'] ?? '';

    // check for new upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // delete old file if exists
        if ($oldGambar && is_file('../img/' . $oldGambar)) {
            unlink('../img/' . $oldGambar);
        }
        $gambarName = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../img/' . $gambarName);

        $stmt = $conn->prepare("UPDATE products SET nama_produk = ?, harga = ?, deskripsi = ?, stok = ?, kategori = ?, image = ? WHERE id = ?");
        $stmt->bind_param('sisissi', $nama, $harga, $deskripsi, $stok, $kategori, $gambarName, $id);
    } else {
        // no new image, update text only
        $stmt = $conn->prepare("UPDATE products SET nama_produk = ?, harga = ?, deskripsi = ?, stok = ?, kategori = ? WHERE id = ?");
        $stmt->bind_param('sisisi', $nama, $harga, $deskripsi, $stok, $kategori, $id);
    }

    $stmt->execute();
    header('Location: index.php?status=updated');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../components/navbar.php'; ?>

    <div class="max-w-lg mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Edit Produk</h1>
        <form action="?id=<?= $id; ?>" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block mb-1">Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= htmlspecialchars($nama); ?>" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Harga</label>
                <input type="number" name="harga" value="<?= htmlspecialchars($harga); ?>" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border px-3 py-2 rounded"><?= htmlspecialchars($deskripsi); ?></textarea>
            </div>
            <div>
                <label class="block mb-1">Stok</label>
                <input type="number" name="stok" value="<?= htmlspecialchars($stok); ?>" class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($kategori); ?>" class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block mb-1">Gambar</label>
                <?php if ($oldGambar): ?>
                    <div class="mb-2">
                        <img src="../img/<?= htmlspecialchars($oldGambar); ?>" alt="" class="w-24 h-24 object-cover">
                    </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="w-full" />
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                <a href="index.php" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
