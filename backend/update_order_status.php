<?php
session_start();

// Check if the user is logged in and has the role of "admin"
if (!isset($_SESSION["user_id"])) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
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
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

// Check if order_id and status are provided
if (!isset($_POST['order_id']) || !isset($_POST['status'])) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit();
}

$order_id = $_POST['order_id'];
$status = $_POST['status'];

// Validate status
$valid_statuses = ['pending', 'processing', 'shipped', 'delivered', 'completed'];
if (!in_array($status, $valid_statuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit();
}

// Update the order status
$sql = "UPDATE orders SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $order_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$stmt->close();
$conn->close();
?> 