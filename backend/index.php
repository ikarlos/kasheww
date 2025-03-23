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
    <title>Products - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include "partials/navbar.php"; ?>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 0px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .table-responsive {
            margin: 0 auto;
            max-width: 1200px;
        }
        .table img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .no-products {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2>Product List - Admin Dashboard</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch products from the database
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='img-fluid'></td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>$" . $row["price"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td>
                                <form action='delete_product.php' method='POST' style='display: inline;' onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>
                                    <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='no-products'>No products found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
