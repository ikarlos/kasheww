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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = $_POST["tag"];
    $image = $_FILES["banner"];

    try {
        // Define the target directory
        $target_dir = "../uploads/";

        // Check if the uploads directory exists, if not create it
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                throw new Exception(
                    "Failed to create directory: $target_dir. Please check the directory permissions."
                );
            }
        }

        // Move the uploaded file to the target directory
        $target_file = $target_dir . basename($image["name"]);

        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
            throw new Exception("Failed to move uploaded file to $target_file");
        }

        // Set permissions for the uploaded file
        if (!chmod($target_file, 0644)) {
            throw new Exception(
                "Failed to set file permissions for $target_file"
            );
        }

        // Insert the banner details into the database (optional)
        $sql = "INSERT INTO banners (tag, image_path) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $tag, $target_file);
        $stmt->execute();
        $stmt->close();

        echo "<div class='alert alert-success'>Banner uploaded successfully!</div>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " .
            $e->getMessage() .
            "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Upload - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
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
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
    <?php include "partials/navbar.php"; ?>

</head>
<body>
    <h2>Banner Upload - Admin Dashboard</h2>
    <div class="form-container">
        <form action="banner_upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tag" class="form-label">Enter Tag</label>
                <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter tag" required>
            </div>
            <div class="mb-3">
                <label for="banner" class="form-label">Upload Banner Image</label>
                <input type="file" class="form-control" id="banner" name="banner" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
