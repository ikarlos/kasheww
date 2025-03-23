<?php
session_start(); // Start the session

// Check if the user is logged in and has the role of "admin"
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page.php"); // Redirect to login page if not logged in
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
    header("Location: ../index.php"); // Redirect to home page if not an admin
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <?php include "partials/navbar.php"; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #81C408;
            --bs-secondary: #FFB524;
            --bs-light: #F4F6F8;
            --bs-dark: #45595B;
        }
        body {
            background-color: var(--bs-light);
            padding: 0px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--bs-dark);
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            color: var(--bs-dark);
            font-weight: 500;
        }
        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(129, 196, 8, 0.25);
        }
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
        .btn-primary:hover {
            background-color: #6ba307;
            border-color: #6ba307;
        }
        select.form-control option {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h2>Upload Product - Admin Dashboard</h2>
    <div class="form-container">
        <form action="upload_product.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Dry Fruit">Dry Fruit</option>
                    <option value="Honey">Honey</option>
                    <option value="Spices">Spices</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
