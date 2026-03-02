<?php
session_start();
require_once "koneksi.php";

// Set user_id dari session atau default ke 1
$_SESSION['user_id'] = $_SESSION['user_id'] ?? 1;
$user_id = $_SESSION['user_id'];

$product_id = $_POST['product_id'] ?? 0;
$quantity = $_POST['quantity'] ?? 1;

// Validate input
if ($product_id <= 0 || $quantity <= 0) {
    header('Location: home.php?error=invalid_input');
    exit;
}

// Check if product exists and has enough stock
$stmt = $conn->prepare("SELECT stok FROM products WHERE id = ?");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product || $product['stok'] < $quantity) {
    header('Location: home.php?error=insufficient_stock');
    exit;
}

// Check if product already in cart
$stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->bind_param('ii', $user_id, $product_id);
$stmt->execute();
$cartResult = $stmt->get_result();
$existingCart = $cartResult->fetch_assoc();
$stmt->close();

if ($existingCart) {
    // Update quantity jika sudah ada di cart
    $newQuantity = $existingCart['quantity'] + $quantity;
    if ($newQuantity > $product['stok']) {
        header('Location: home.php?error=insufficient_stock');
        exit;
    }
    $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $updateStmt->bind_param('ii', $newQuantity, $existingCart['id']);
    $updateStmt->execute();
    $updateStmt->close();
} else {
    // Insert ke cart jika belum ada
    $insertStmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $insertStmt->bind_param('iii', $user_id, $product_id, $quantity);
    $insertStmt->execute();
    $insertStmt->close();
}

header('Location: home.php?success=added_to_cart');
exit;
