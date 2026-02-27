<?php
    require_once "koneksi.php";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <title>Data Produk</title>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-weight: 700;
            margin: 0;
        }
        .page-header p {
            margin: 0.5rem 0 0;
            opacity: 0.85;
        }

        /* Search & Filter Bar */
        .filter-bar {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 2rem;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            border-radius: 8px;
            border: 1.5px solid #dee2e6;
            padding: 0.6rem 1rem;
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }
        .btn-search {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-search:hover {
            opacity: 0.9;
            color: white;
        }
        .btn-reset {
            border: 1.5px solid #dee2e6;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            color: #6c757d;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-reset:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }

        /* Product Cards */
        .product-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .product-card .card-body {
            padding: 1.25rem;
        }
        .product-card .card-title {
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 0.75rem;
        }
        .badge-kategori {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35em 0.75em;
            border-radius: 6px;
        }
        .product-price {
            font-size: 1.15rem;
            font-weight: 700;
            color: #2d3436;
        }
        .product-desc {
            color: #636e72;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        .stock-info {
            font-size: 0.85rem;
            color: #636e72;
        }
        .stock-info i {
            margin-right: 4px;
        }

        /* Result info */
        .result-info {
            color: #636e72;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #636e72;
        }
        .empty-state i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-box-seam"></i> Data Produk</h1>
            <p>Kelola dan cari produk dengan mudah</p>
        </div>
    </div>

    <div class="container">

        <!-- Search & Filter Bar -->
        <form method="GET" action="" class="filter-bar">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-semibold"><i class="bi bi-search"></i> Cari Produk</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Ketik nama atau deskripsi produk..." 
                           value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold"><i class="bi bi-tag"></i> Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= htmlspecialchars($kat) ?>" 
                                    <?= ($kategori === $kat) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="home.php" class="btn btn-reset">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Result Info -->
        <div class="result-info">
            Menampilkan <strong><?= count($products) ?></strong> produk
            <?php if (!empty($search)): ?>
                untuk pencarian "<strong><?= htmlspecialchars($search) ?></strong>"
            <?php endif; ?>
            <?php if (!empty($kategori)): ?>
                dalam kategori "<strong><?= htmlspecialchars($kategori) ?></strong>"
            <?php endif; ?>
        </div>

        <!-- Product Cards -->
        <div class="row">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($product["nama_produk"]) ?></h5>
                                    <span class="badge badge-kategori"><?= htmlspecialchars($product["kategori"]) ?></span>
                                </div>
                                <p class="product-desc"><?= htmlspecialchars($product["deskripsi"]) ?></p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">Rp <?= number_format($product["harga"], 0, ',', '.') ?></span>
                                        <span class="stock-info">
                                            <i class="bi bi-box"></i> Stok: <?= $product["stok"] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-inbox d-block"></i>
                        <h5>Produk Tidak Ditemukan</h5>
                        <p>Coba ubah kata kunci pencarian atau filter kategori.</p>
                        <a href="home.php" class="btn btn-search mt-2">
                            <i class="bi bi-arrow-counterclockwise"></i> Tampilkan Semua
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Footer -->
    <div class="text-center text-muted py-4 mt-4" style="font-size: 0.85rem;">
        &copy; 2026 Data Produk &mdash; Sesi 8
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>
</html>