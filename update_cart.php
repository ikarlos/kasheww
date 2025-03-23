<?php
session_start();

// Include database connection
include "./db/db_connection.php";

// Set header to return JSON
header('Content-Type: application/json');

// Handle quantity updates
if (isset($_POST['action']) && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    
    if ($_POST['action'] === 'update_quantity') {
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if ($quantity > 0) {
            $cart[$item_id] = $quantity;
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
        }
    } else if ($_POST['action'] === 'remove') {
        if (isset($cart[$item_id])) {
            unset($cart[$item_id]);
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
} 