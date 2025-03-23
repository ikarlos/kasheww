<?php
session_start(); // Start the session

// Check if the user is logged in and has the role of "admin"
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page.php"); // Redirect to login page if not logged in
    exit();
}

include "../db/db_connection.php"; // Include database connection

// Fetch the user's role from the database
$user_id = $_SESSION["user_id"];
$sql = "SELECT role FROM userdata WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();

if ($role !== "admin") {
    header("Location: ../index.php"); // Redirect to home page if not an admin
    exit();
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-white">
    <div class="container-fluid">
        <a class="navbar-brand me-5" href="index.php">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-4">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="product_upload.php">Upload Product</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="banner_upload.php">Upload Banner</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="display_orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
