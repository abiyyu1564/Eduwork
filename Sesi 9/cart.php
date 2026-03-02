<?php
session_start();
require_once "koneksi.php";

$user_id = $_SESSION['user_id'] ?? 1;

// Get all cart items for this user
$stmt = $conn->prepare("
    SELECT c.id, c.quantity, p.id as product_id, p.nama_produk, p.harga, p.image, p.stok
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
    ORDER BY c.created_at DESC
");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = [];
$totalHarga = 0;

while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
    $totalHarga += $row['harga'] * $row['quantity'];
}
$stmt->close();

// Handle remove from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $cart_id = $_POST['cart_id'] ?? 0;

    if ($action === 'remove' && $cart_id > 0) {
        $deleteStmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
        $deleteStmt->bind_param('ii', $cart_id, $user_id);
        $deleteStmt->execute();
        $deleteStmt->close();
        header('Location: cart.php');
        exit;
    } elseif ($action === 'update' && $cart_id > 0) {
        $newQuantity = $_POST['quantity'] ?? 1;
        if ($newQuantity > 0) {
            // Check stock first
            $checkStmt = $conn->prepare("SELECT p.stok FROM cart c JOIN products p ON c.product_id = p.id WHERE c.id = ?");
            $checkStmt->bind_param('i', $cart_id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            $checkRow = $checkResult->fetch_assoc();
            $checkStmt->close();

            if ($checkRow && $newQuantity <= $checkRow['stok']) {
                $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
                $updateStmt->bind_param('iii', $newQuantity, $cart_id, $user_id);
                $updateStmt->execute();
                $updateStmt->close();
            }
        }
        header('Location: cart.php');
        exit;
    } elseif ($action === 'checkout' && count($cartItems) > 0) {
        // Create transaction
        $transStmt = $conn->prepare("INSERT INTO transaction (user_id, total_harga, status) VALUES (?, ?, 'success')");
        $transStmt->bind_param('id', $user_id, $totalHarga);
        $transStmt->execute();
        $transaction_id = $transStmt->insert_id;
        $transStmt->close();

        // Create detail_transaksi for each item
        foreach ($cartItems as $item) {
            $detailStmt = $conn->prepare("INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga_saat_beli) VALUES (?, ?, ?, ?)");
            $detailStmt->bind_param('iiii', $transaction_id, $item['product_id'], $item['quantity'], $item['harga']);
            $detailStmt->execute();
            $detailStmt->close();
        }

        // Clear cart
        $clearStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $clearStmt->bind_param('i', $user_id);
        $clearStmt->execute();
        $clearStmt->close();

        header('Location: cart.php?success=checkout');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Keranjang Belanja</title>
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .gradient-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <!-- Header -->
    <div class="gradient-header text-white py-8 mb-8">
        <div class="max-w-6xl mx-auto px-4">
            <h1 class="text-3xl font-bold flex items-center gap-2">
                🛒 Keranjang Belanja
            </h1>
            <p class="mt-2 text-white/80">Kelola produk pilihan Anda</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 mb-8">
        <?php if (isset($_GET['success']) && $_GET['success'] === 'checkout'): ?>
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded-lg">
                ✅ Checkout berhasil! Terima kasih atas pembelian Anda.
            </div>
        <?php endif; ?>

        <?php if (count($cartItems) > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm">
                        <?php foreach ($cartItems as $index => $item): ?>
                            <div class="p-4 border-b last:border-b-0 flex gap-4">
                                <!-- Image -->
                                <div class="flex-shrink-0">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="./img/<?= htmlspecialchars($item['image']) ?>" alt="" class="w-24 h-24 object-cover rounded-lg">
                                    <?php else: ?>
                                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-2xl">📦</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Details -->
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-800"><?= htmlspecialchars($item['nama_produk']) ?></h3>
                                    <p class="text-gray-500 text-sm mb-2">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                    
                                    <!-- Quantity & Remove -->
                                    <div class="flex items-center gap-2">
                                        <form method="POST" action="cart.php" class="flex items-center gap-1">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['stok'] ?>" class="w-16 border border-gray-300 rounded px-2 py-1 text-sm">
                                            <button type="submit" class="text-blue-600 text-sm font-semibold hover:underline">Update</button>
                                        </form>

                                        <form method="POST" action="cart.php" class="ml-2">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="text-red-600 text-sm font-semibold hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?></p>
                                    <p class="text-gray-500 text-xs">x<?= $item['quantity'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Summary -->
                <div class="bg-white rounded-lg shadow-sm h-fit sticky top-4">
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">📋 Ringkasan</h2>
                        
                        <div class="space-y-3 mb-4 pb-4 border-b">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Item:</span>
                                <span class="font-semibold"><?= count($cartItems) ?></span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal:</span>
                                <span class="font-semibold">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
                            </div>
                        </div>

                        <div class="flex justify-between text-lg font-bold text-gray-800 mb-4">
                            <span>Total:</span>
                            <span>Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
                        </div>

                        <form method="POST" action="cart.php" class="mb-3">
                            <input type="hidden" name="action" value="checkout">
                            <button type="submit" class="w-full gradient-btn text-white font-bold rounded-lg py-3 text-sm cursor-pointer transition">
                                ✅ Checkout
                            </button>
                        </form>

                        <a href="home.php" class="block text-center border border-gray-300 text-gray-600 font-semibold rounded-lg py-2 text-sm hover:bg-gray-50 transition no-underline">
                            ← Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <div class="text-5xl mb-4">🛒</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h2>
                <p class="text-gray-500 mb-6">Belum ada produk di keranjang Anda. Mulai belanja sekarang!</p>
                <a href="home.php" class="inline-block gradient-btn text-white font-bold rounded-lg px-8 py-3 text-sm no-underline transition">
                    🏠 Kembali ke Belanja
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="text-center text-gray-400 text-xs py-6 mt-8">
        &copy; 2026 Keranjang Belanja &mdash; Sesi 9
    </div>

</body>
</html>
