<?php
session_start();
include "./db/db_connection.php";

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

if (!$order_id) {
    header('Location: index.php');
    exit();
}

// Get order details
$order_sql = "SELECT * FROM orders WHERE id = ?";
$order_stmt = $conn->prepare($order_sql);
$order_stmt->bind_param("i", $order_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
$order = $order_result->fetch_assoc();

if (!$order) {
    header('Location: index.php');
    exit();
}

// Get order items
$items_sql = "SELECT oi.*, p.name, p.image 
              FROM order_items oi 
              JOIN products p ON oi.product_id = p.id 
              WHERE oi.order_id = ?";
$items_stmt = $conn->prepare($items_sql);
$items_stmt->bind_param("i", $order_id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();
$order_items = $items_result->fetch_all(MYSQLI_ASSOC);
?>

<?php include "./partials/header.php"; ?>

<body>
    <!-- Include Navbar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Order Confirmation</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Order Confirmation</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Order Confirmation Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <div class="text-center mb-5">
                                <i class="fas fa-check-circle text-primary" style="font-size: 4rem;"></i>
                                <h2 class="mt-3">Thank You for Your Order!</h2>
                                <p class="text-muted">Order #<?php echo $order_id; ?></p>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <h4 class="mb-3">Order Details</h4>
                                    <p><strong>Order Date:</strong> <?php echo date('F j, Y', strtotime($order['order_date'])); ?></p>
                                    <p><strong>Payment Method:</strong> <?php echo ucwords(str_replace('_', ' ', $order['payment_method'])); ?></p>
                                    <p><strong>Shipping Method:</strong> <?php echo ucwords(str_replace('_', ' ', $order['shipping_method'])); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-3">Shipping Address</h4>
                                    <p><?php echo htmlspecialchars($order['first_name'] . ' ' . $order['last_name']); ?></p>
                                    <p><?php echo htmlspecialchars($order['company']); ?></p>
                                    <p><?php echo htmlspecialchars($order['address']); ?></p>
                                    <p><?php echo htmlspecialchars($order['city'] . ', ' . $order['country'] . ' ' . $order['postcode']); ?></p>
                                </div>
                            </div>

                            <h4 class="mb-3">Order Items</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_items as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="<?php echo str_replace('../uploads/', './uploads/', $item['image']); ?>" 
                                                             class="img-fluid rounded-circle me-2" 
                                                             style="width: 50px; height: 50px;" 
                                                             alt="<?php echo htmlspecialchars($item['name']); ?>">
                                                        <?php echo htmlspecialchars($item['name']); ?>
                                                    </div>
                                                </td>
                                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                                <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                            <td>$<?php echo number_format($order['subtotal'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Shipping:</strong></td>
                                            <td>$<?php echo number_format($order['shipping_cost'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td><strong>$<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php if ($order['order_notes']): ?>
                                <div class="mt-4">
                                    <h4 class="mb-3">Order Notes</h4>
                                    <p><?php echo nl2br(htmlspecialchars($order['order_notes'])); ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="text-center mt-5">
                                <a href="shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Confirmation End -->

    <!-- Include Footer -->
    <?php include "./partials/footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html> 