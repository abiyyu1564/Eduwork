<?php
    session_start();
    require_once "koneksi.php";

    // Set default user_id untuk demo
    $_SESSION['user_id'] = $_SESSION['user_id'] ?? 1;
    $user_id = $_SESSION['user_id'];

    // Ambil jumlah item di cart
    $cartCount = 0;
    $cartStmt = $conn->prepare("SELECT SUM(quantity) as total FROM cart WHERE user_id = ?");
    $cartStmt->bind_param('i', $user_id);
    $cartStmt->execute();
    $cartResult = $cartStmt->get_result();
    if ($cartRow = $cartResult->fetch_assoc()) {
        $cartCount = $cartRow['total'] ?? 0;
    }
    $cartStmt->close();

    // Ambil parameter search dan kategori dari URL
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

    // Query untuk ambil semua kategori unik (untuk dropdown filter)
    $kategoriQuery = "SELECT DISTINCT kategori FROM products ORDER BY kategori";
    $kategoriResult = $conn->query($kategoriQuery);
    $kategoriList = [];
    while ($row = $kategoriResult->fetch_assoc()) {
        $kategoriList[] = $row['kategori'];
    }

    // Query utama dengan filter search dan kategori
    $query = "SELECT * FROM products WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($search)) {
        $query .= " AND (nama_produk LIKE ? OR deskripsi LIKE ?)";
        $searchParam = "%$search%";
        $params[] = $searchParam;
        $params[] = $searchParam;
        $types .= 'ss';
    }

    if (!empty($kategori)) {
        $query .= " AND kategori = ?";
        $params[] = $kategori;
        $types .= 's';
    }

    $query .= " ORDER BY nama_produk ASC";

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Data Produk</title>
    <style>
        /* Custom gradient & transition yang tidak bisa dilakukan murni di Tailwind */
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .gradient-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .gradient-btn:hover {
            opacity: 0.9;
        }
        .card-hover {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <!-- Header -->
    <div class="gradient-header text-white py-8 mb-8">
        <div class="flex mx-auto max-w-6xl justify-between">
        <div class="px-4">
            <h1 class="text-3xl font-bold flex items-center gap-2">
                📦 Data Produk
            </h1>
            <p class="mt-2 text-white/80">Kelola dan cari produk dengan mudah</p>
        </div>
        <div class="flex gap-3">
            <a href="./cart.php" 
               class="border border-white/80 text-white font-semibold rounded-lg px-5 py-2.5 text-sm hover:bg-white/10 transition no-underline flex items-center gap-2">
                🛒 Keranjang <?php if ($cartCount > 0): ?><span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs"><?= $cartCount ?></span><?php endif; ?>
            </a>
            <a href="./admin/adminPage.php" 
               class="border border-white/80 text-white font-semibold rounded-lg px-5 py-2.5 text-sm hover:bg-white/10 transition no-underline">
                🏠 Admin Page
            </a>
        </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4">

        <!-- Search & Filter Bar -->
        <form method="GET" action="" class="bg-white rounded-xl p-5 shadow-sm mb-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🔍 Cari Produk</label>
                    <input type="text" name="search" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition"
                           placeholder="Ketik nama atau deskripsi produk..." 
                           value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">🏷️ Kategori</label>
                    <select name="kategori" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition bg-white">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= htmlspecialchars($kat) ?>" 
                                    <?= ($kategori === $kat) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="md:col-span-4 flex gap-2">
                    <button type="submit" 
                            class="gradient-btn text-white font-semibold rounded-lg px-6 py-2.5 text-sm cursor-pointer transition">
                        🔍 Cari
                    </button>
                    <a href="home.php" 
                       class="border border-gray-300 text-gray-500 font-semibold rounded-lg px-5 py-2.5 text-sm hover:bg-gray-50 hover:border-gray-400 transition no-underline">
                        ↺ Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Result Info -->
        <p class="text-gray-500 text-sm mb-4">
            Menampilkan <strong class="text-gray-700"><?= count($products) ?></strong> produk
            <?php if (!empty($search)): ?>
                untuk pencarian "<strong class="text-gray-700"><?= htmlspecialchars($search) ?></strong>"
            <?php endif; ?>
            <?php if (!empty($kategori)): ?>
                dalam kategori "<strong class="text-gray-700"><?= htmlspecialchars($kategori) ?></strong>"
            <?php endif; ?>
        </p>

        <!-- Product Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-xl shadow-sm card-hover overflow-hidden flex flex-col">
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-bold text-gray-800 leading-tight">
                                    <?= htmlspecialchars($product["nama_produk"]) ?>
                                </h3>
                                <span class="gradient-badge text-white text-xs font-semibold px-2.5 py-1 rounded-md whitespace-nowrap ml-2">
                                    <?= htmlspecialchars($product["kategori"]) ?>
                                </span>
                            </div>
                            <p class="text-gray-500 text-sm mb-4 flex-1">
                                <?= htmlspecialchars($product["deskripsi"]) ?>
                            </p>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <span class="text-lg font-bold text-gray-800">
                                    Rp <?= number_format($product["harga"], 0, ',', '.') ?>
                                </span>
                                <span class="text-sm text-gray-500">
                                    📦 Stok: <?= $product["stok"] ?>
                                </span>
                            </div>
                            <form action="add_to_cart.php" method="POST" class="mt-4 pt-3 border-t border-gray-100 flex gap-2">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="number" name="quantity" value="1" min="1" max="<?= $product['stok'] ?>" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                                <button type="submit" class="flex-1 gradient-btn text-white font-semibold rounded-lg py-2 text-sm cursor-pointer transition" <?php if ($product['stok'] == 0) echo 'disabled style="opacity: 0.5; cursor: not-allowed;"'; ?>>
                                    <?php if ($product['stok'] == 0): ?>
                                        ❌ Stok Habis
                                    <?php else: ?>
                                        🛒 Add to Cart
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                        </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full">
                    <div class="text-center py-12 text-gray-400">
                        <div class="text-5xl mb-4">📭</div>
                        <h3 class="text-lg font-semibold text-gray-600 mb-1">Produk Tidak Ditemukan</h3>
                        <p class="text-sm mb-4">Coba ubah kata kunci pencarian atau filter kategori.</p>
                        <a href="home.php" 
                           class="inline-block gradient-btn text-white font-semibold rounded-lg px-6 py-2.5 text-sm no-underline transition">
                            ↺ Tampilkan Semua
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Footer -->
    <div class="text-center text-gray-400 text-xs py-6 mt-8">
        &copy; 2026 Data Produk &mdash; Sesi 9
    </div>

</body>
</html>
