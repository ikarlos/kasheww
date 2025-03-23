<?php
session_start();
include "./db/db_connection.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get cart items
        $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
        
        if (empty($cart)) {
            throw new Exception("Your cart is empty");
        }

        // Calculate subtotal first
        $subtotal = 0;
        $cart_items = [];
        
        // Get product prices and calculate subtotal
        foreach ($cart as $product_id => $quantity) {
            $price_sql = "SELECT price FROM products WHERE id = ?";
            $price_stmt = $conn->prepare($price_sql);
            if (!$price_stmt) {
                throw new Exception("Error preparing price query: " . $conn->error);
            }
            
            $price_stmt->bind_param("i", $product_id);
            if (!$price_stmt->execute()) {
                throw new Exception("Error executing price query: " . $price_stmt->error);
            }
            
            $price_result = $price_stmt->get_result();
            $product = $price_result->fetch_assoc();
            
            if (!$product) {
                throw new Exception("Product not found with ID: " . $product_id);
            }
            
            $item_subtotal = $product['price'] * $quantity;
            $subtotal += $item_subtotal;
            
            // Store item details for later use
            $cart_items[] = [
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $product['price'],
                'subtotal' => $item_subtotal
            ];
        }
        
        // Get shipping cost based on selected method
        $shipping_cost = 0;
        switch ($_POST['shipping']) {
            case 'flat':
                $shipping_cost = 15.00;
                break;
            case 'local':
                $shipping_cost = 8.00;
                break;
            default:
                $shipping_cost = 0.00;
        }

        // Calculate total amount
        $total_amount = $subtotal + $shipping_cost;

        // Start transaction
        if (!$conn->begin_transaction()) {
            throw new Exception("Error starting transaction: " . $conn->error);
        }

        // Insert order details
        $sql = "INSERT INTO orders (
            first_name, last_name, company, address, city, country, 
            postcode, mobile, email, create_account, different_address, 
            order_notes, shipping_method, payment_method, subtotal, 
            shipping_cost, total_amount
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing order query: " . $conn->error);
        }

        $create_account = isset($_POST['create_account']) ? 1 : 0;
        $different_address = isset($_POST['different_address']) ? 1 : 0;

        $stmt->bind_param(
            "ssssssssiiisssddd",
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['company'],
            $_POST['address'],
            $_POST['city'],
            $_POST['country'],
            $_POST['postcode'],
            $_POST['mobile'],
            $_POST['email'],
            $create_account,
            $different_address,
            $_POST['order_notes'],
            $_POST['shipping'],
            $_POST['payment_method'],
            $subtotal,
            $shipping_cost,
            $total_amount
        );

        if (!$stmt->execute()) {
            throw new Exception("Error executing order query: " . $stmt->error);
        }

        $order_id = $conn->insert_id;

        // Insert order items
        $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)";
        $item_stmt = $conn->prepare($item_sql);
        if (!$item_stmt) {
            throw new Exception("Error preparing order items query: " . $conn->error);
        }

        foreach ($cart_items as $item) {
            $item_stmt->bind_param("iiidd", 
                $order_id, 
                $item['product_id'], 
                $item['quantity'], 
                $item['price'], 
                $item['subtotal']
            );
            
            if (!$item_stmt->execute()) {
                throw new Exception("Error executing order items query: " . $item_stmt->error);
            }
        }

        // Commit transaction
        if (!$conn->commit()) {
            throw new Exception("Error committing transaction: " . $conn->error);
        }

        // Clear cart
        setcookie('cart', '', time() - 3600, '/');

        // Redirect to thank you page
        header('Location: thank_you.php?order_id=' . $order_id);
        exit();

    } catch (Exception $e) {
        // Rollback transaction on error
        if ($conn->inTransaction()) {
            $conn->rollback();
        }
        
        // Display error message
        echo "<div style='color: red; padding: 20px; margin: 20px; border: 1px solid red; border-radius: 5px;'>";
        echo "<h2>Error Processing Order</h2>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p>Please try again or contact support if the problem persists.</p>";
        echo "</div>";
        
        // Log the error
        error_log("Order Processing Error: " . $e->getMessage());
    }
} else {
    // If not POST request, redirect to cart
    header('Location: cart.php');
    exit();
} 