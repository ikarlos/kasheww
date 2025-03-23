<?php
session_start();

// Include database connection
include "./db/db_connection.php";

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you would process the order
    // For now, we'll just clear the cart and redirect to a thank you page
    setcookie('cart', '', time() - 3600, '/');
    header('Location: thank_you.php');
    exit();
}
?>

<?php include "./partials/header.php"; ?>

<body>
    <!-- Include Navbar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form method="POST" action="process_order.php">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Company Name<sup>*</sup></label>
                            <input type="text" name="company" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" name="address" class="form-control" placeholder="House Number Street Name" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" name="country" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" name="postcode" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" name="mobile" class="form-control" required>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="create_account" value="1">
                            <label class="form-check-label" for="Account-1">Create an account?</label>
                        </div>
                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="different_address" value="1">
                            <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                        </div>
                        <div class="form-item">
                            <textarea name="order_notes" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($cart_items)): ?>
                                        <?php foreach ($cart_items as $item): ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="<?php echo str_replace('../uploads/', './uploads/', $item['image']); ?>" 
                                                             class="img-fluid rounded-circle" 
                                                             style="width: 90px; height: 90px;" 
                                                             alt="<?php echo htmlspecialchars($item['name']); ?>">
                                                    </div>
                                                </th>
                                                <td class="py-5"><?php echo htmlspecialchars($item['name']); ?></td>
                                                <td class="py-5">$<?php echo number_format($item['price'], 2); ?></td>
                                                <td class="py-5"><?php echo $item['quantity']; ?></td>
                                                <td class="py-5">$<?php echo number_format($item['subtotal'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-3">Subtotal</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">$<?php echo number_format($subtotal, 2); ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-4">Shipping</p>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-start">
                                                    <input type="radio" class="form-check-input bg-primary border-0" id="Shipping-1" name="shipping" value="free" checked>
                                                    <label class="form-check-label" for="Shipping-1">Free Shipping</label>
                                                </div>
                                                <div class="form-check text-start">
                                                    <input type="radio" class="form-check-input bg-primary border-0" id="Shipping-2" name="shipping" value="flat">
                                                    <label class="form-check-label" for="Shipping-2">Flat rate: $15.00</label>
                                                </div>
                                                <div class="form-check text-start">
                                                    <input type="radio" class="form-check-input bg-primary border-0" id="Shipping-3" name="shipping" value="local">
                                                    <label class="form-check-label" for="Shipping-3">Local Pickup: $8.00</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">$<?php echo number_format($total, 2); ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <p class="mb-0">Your cart is empty</p>
                                                <a href="shop.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary mt-3">Continue Shopping</a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1" name="payment_method" value="bank_transfer" checked>
                                    <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                </div>
                                <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1" name="payment_method" value="check">
                                    <label class="form-check-label" for="Payments-1">Check Payments</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="payment_method" value="cod">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="payment_method" value="paypal">
                                    <label class="form-check-label" for="Paypal-1">Paypal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->

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