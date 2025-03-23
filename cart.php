<?php
session_start();

// Include database connection
include "./db/db_connection.php";

// Handle quantity updates
if (isset($_POST['action']) && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    
    if ($_POST['action'] === 'update_quantity') {
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if ($quantity > 0) {
            $cart[$item_id] = $quantity;
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
        }
    } else if ($_POST['action'] === 'remove') {
        if (isset($cart[$item_id])) {
            unset($cart[$item_id]);
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
        }
    }
    
    // Redirect to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Get current cart items
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Calculate totals
$subtotal = 0;
$shipping = 3.00; // Fixed shipping rate
$total = 0;

// Get cart items details
$cart_items = [];
if (!empty($cart)) {
    $item_ids = array_keys($cart);
    $ids_string = implode(',', array_map('intval', $item_ids));
    $sql = "SELECT * FROM products WHERE id IN ($ids_string)";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $cart[$row['id']];
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $subtotal += $row['subtotal'];
        $cart_items[] = $row;
    }
}

$total = $subtotal + $shipping;
?>

<?php include "./partials/header.php"; ?>

<body>
    <!-- Include Navbar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cart_items)): ?>
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo str_replace('../uploads/', './uploads/', $item['image']); ?>" 
                                                 class="img-fluid me-5 rounded-circle" 
                                                 style="width: 80px; height: 80px;" 
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo htmlspecialchars($item['name']); ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">$<?php echo number_format($item['price'], 2); ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <input type="hidden" name="action" value="update_quantity">
                                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                            <div class="input-group-btn">
                                                <button type="button" onclick="updateQuantity(<?php echo $item['id']; ?>, <?php echo max(1, $item['quantity'] - 1); ?>)" 
                                                        class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" id="quantity_<?php echo $item['id']; ?>" class="form-control form-control-sm text-center border-0" 
                                                   value="<?php echo $item['quantity']; ?>" min="1" readonly>
                                            <div class="input-group-btn">
                                                <button type="button" onclick="updateQuantity(<?php echo $item['id']; ?>, <?php echo $item['quantity'] + 1; ?>)" 
                                                        class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">$<?php echo number_format($item['subtotal'], 2); ?></p>
                                    </td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="mb-0">Your cart is empty</p>
                                    <a href="shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary mt-3">Continue Shopping</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($cart_items)): ?>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0">$<?php echo number_format($subtotal, 2); ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: $<?php echo number_format($shipping, 2); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4">$<?php echo number_format($total, 2); ?></p>
                            </div>
                            <a href="checkout.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Cart Page End -->

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
    <script>
    function updateQuantity(itemId, newQuantity) {
        if (newQuantity < 1) return;
        
        // Send AJAX request to update quantity
        fetch('update_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=update_quantity&item_id=${itemId}&quantity=${newQuantity}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the quantity display
                document.getElementById(`quantity_${itemId}`).value = newQuantity;
                // Reload the page to update totals
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html> 