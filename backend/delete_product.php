<?php
session_start();

// Check if the user is logged in and has the role of "admin"
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page.php");
    exit();
}

include "../db/db_connection.php";

// Fetch the user's role from the database
$user_id = $_SESSION["user_id"];
$sql = "SELECT role FROM userdata WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();

if ($role !== "admin") {
    header("Location: ../index.php");
    exit();
}

// Check if product_id is provided
if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    $_SESSION['error'] = "Product ID is required";
    header("Location: index.php");
    exit();
}

$product_id = intval($_POST['product_id']);

// First, get the image path to delete the file
$sql = "SELECT image FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if ($product) {
    // Delete the product from database
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        // If database deletion was successful, try to delete the image file
        if (!empty($product['image'])) {
            $image_path = "../" . $product['image']; // Adjust path as needed
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $_SESSION['success'] = "Product deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting product";
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Product not found";
}

$conn->close();

// Redirect back to the products page
header("Location: index.php");
exit(); 