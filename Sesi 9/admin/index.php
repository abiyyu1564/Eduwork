<?php
// dashboard listing products
include '../koneksi.php';

// make sure table exists (some environments may not have it yet)
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

// handle optional status message
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include '../components/navbar.php'; ?>

    <div class="max-w-6xl mx-auto p-4">
        <?php if ($status): ?>
            <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                <?php
                    switch ($status) {
                        case 'created': echo 'Produk berhasil ditambahkan.'; break;
                        case 'updated': echo 'Produk berhasil diubah.'; break;
                        case 'deleted': echo 'Produk berhasil dihapus.'; break;
                        default: echo htmlspecialchars($status);
                    }
                ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Data Produk</h1>
            <a href="create.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah Produk</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM products";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?= htmlspecialchars($row['id']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['nama_produk']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['harga']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['stok']); ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['kategori']); ?></td>
                        <td class="px-4 py-2">
                            <?php if (!empty($row['image'])): ?>
                                <img src="../img/<?= htmlspecialchars($row['image']); ?>" alt="" class="w-16 h-16 object-cover">
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="edit.php?id=<?= $row['id']; ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                            <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?');" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
