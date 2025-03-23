<?php
include("../db/db_connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category']; // Retrieve category input
    echo $category;
    $image = $_FILES['image'];

    try {
        // Define the target directory
        $target_dir = "../uploads/";

        // Check if the uploads directory exists, if not create it
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                throw new Exception("Failed to create directory: $target_dir. Please check the directory permissions.");
            }
        }

        // Move the uploaded file to the target directory
        $target_file = $target_dir . basename($image["name"]);
        
        if (!move_uploaded_file($image["tmp_name"], $target_file)) {
            throw new Exception("Failed to move uploaded file to $target_file");
        }
        
        // Set permissions for the uploaded file
        if (!chmod($target_file, 0644)) {
            throw new Exception("Failed to set file permissions for $target_file");
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            
            $stmt->bind_param("ssdss", $product_name, $description, $price, $category, $target_file); // Updated bind_param with category
            echo "here";

        if (!$stmt->execute()) {

            throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        echo "Product uploaded successfully.";

        $stmt->close();

        header("Location: index.php");
        exit(); // Ensure that script execution stops after redirection
    } catch (Exception $e) {
        die("Sorry, there was an error uploading your file: " . $e->getMessage());
    }
} else {
    die("Form submission method is not POST.");
}

$conn->close();
?>
