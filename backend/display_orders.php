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
    <title>Orders - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include "partials/navbar.php"; ?>
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
        .table-responsive {
            margin: 0 auto;
            max-width: 1200px;
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
        }
        .no-orders {
            text-align: center;
            color: var(--bs-dark);
            padding: 20px;
        }
        .table thead th {
            background-color: var(--bs-primary);
            color: white;
            border: none;
        }
        .table tbody tr:hover {
            background-color: rgba(129, 196, 8, 0.1);
        }
        .order-status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }
        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }
        .status-delivered {
            background-color: #d1e7dd;
            color: #0f5132;
        }
    </style>
</head>
<body>
    <h2>Orders List - Admin Dashboard</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Shipping Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch orders from the database
                $sql = "SELECT o.*, 
                        GROUP_CONCAT(CONCAT(oi.quantity, 'x ', p.name) SEPARATOR ', ') as items
                        FROM orders o 
                        LEFT JOIN order_items oi ON o.id = oi.order_id 
                        LEFT JOIN products p ON oi.product_id = p.id 
                        GROUP BY o.id 
                        ORDER BY o.order_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>#" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["first_name"] . " " . $row["last_name"]) . "</td>";
                        echo "<td>" . date('M j, Y', strtotime($row["order_date"])) . "</td>";
                        echo "<td>" . htmlspecialchars($row["items"]) . "</td>";
                        echo "<td>$" . number_format($row["total_amount"], 2) . "</td>";
                        echo "<td><span class='order-status status-" . strtolower($row["status"]) . "'>" . ucfirst($row["status"]) . "</span></td>";
                        echo "<td>" . ucwords(str_replace('_', ' ', $row["payment_method"])) . "</td>";
                        echo "<td>" . ucwords(str_replace('_', ' ', $row["shipping_method"])) . "</td>";
                        echo "<td>";
                        if ($row["status"] !== "completed") {
                            echo "<button class='btn btn-success btn-sm complete-order' data-order-id='" . $row["id"] . "'>Mark as Completed</button>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='no-orders'>No orders found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const completeButtons = document.querySelectorAll('.complete-order');
            completeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    if (confirm('Are you sure you want to mark this order as completed?')) {
                        fetch('update_order_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'order_id=' + orderId + '&status=completed'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Error updating order status');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error updating order status');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
