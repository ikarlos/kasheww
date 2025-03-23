<?php
session_start(); // Start the session

// Include database connection
include "./db/db_connection.php";

// Handle search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

// Build the SQL query with search and sort
$sql = "SELECT * FROM products WHERE 1=1";
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND (name LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%')";
}

// Add sorting
switch($sort) {
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    case 'name_asc':
        $sql .= " ORDER BY name ASC";
        break;
    case 'name_desc':
        $sql .= " ORDER BY name DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
}

$result = $conn->query($sql);

// Handle cart actions
if (isset($_POST['action']) && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    
    if ($_POST['action'] === 'add') {
        if (!isset($cart[$item_id])) {
            $cart[$item_id] = 1;
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
        }
    } else if ($_POST['action'] === 'remove') {
        if (isset($cart[$item_id])) {
            unset($cart[$item_id]);
            setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
        }
    }
    
    header('Location: ' . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET));
    exit();
}

// Get current cart items
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Get categories for sidebar
$categories_sql = "SELECT category, COUNT(*) as count FROM products GROUP BY category";
$categories_result = $conn->query($categories_sql);
?>

<?php include "./partials/header.php"; ?>

<body>
    <!-- Include Navbar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <form method="GET" class="input-group w-100 mx-auto d-flex">
                                <input type="search" name="search" class="form-control p-3" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                                <button type="submit" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="sort">Sort by:</label>
                                <select id="sort" name="sort" class="border-0 form-select-sm bg-light me-3" onchange="window.location.href=this.value">
                                    <option value="">Default</option>
                                    <option value="?sort=price_asc" <?php echo $sort === 'price_asc' ? 'selected' : ''; ?>>Price: Low to High</option>
                                    <option value="?sort=price_desc" <?php echo $sort === 'price_desc' ? 'selected' : ''; ?>>Price: High to Low</option>
                                    <option value="?sort=name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>Name: A to Z</option>
                                    <option value="?sort=name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>>Name: Z to A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <!-- Sidebar -->
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <?php while($category = $categories_result->fetch_assoc()): ?>
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="?category=<?php echo urlencode($category['category']); ?>">
                                                        <i class="fas fa-apple-alt me-2"></i><?php echo htmlspecialchars($category['category']); ?>
                                                    </a>
                                                    <span>(<?php echo $category['count']; ?>)</span>
                                                </div>
                                            </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Grid -->
                        <div class="col-lg-9">
                            <div class="row g-4">
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $image_path = str_replace("../uploads/", "./uploads/", $row["image"]);
                                        $is_in_cart = isset($cart[$row['id']]);
                                        $button_text = $is_in_cart ? 'Remove from cart' : 'Add to cart';
                                        $action = $is_in_cart ? 'remove' : 'add';
                                        $button_class = $is_in_cart ? 'btn-danger' : 'border border-secondary text-primary';
                                        $icon_class = $is_in_cart ? 'text-white' : 'text-primary';

                                        echo '
                                        <div class="col-md-6 col-lg-4">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="' . $image_path . '" class="img-fluid w-100 rounded-top" alt="' . htmlspecialchars($row["name"]) . '">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . 
                                                    htmlspecialchars($row["category"]) . 
                                                '</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>' . htmlspecialchars($row["name"]) . '</h4>
                                                    <p>' . htmlspecialchars($row["description"]) . '</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$' . 
                                                            number_format($row["price"], 2) . 
                                                        ' / kg</p>
                                                        <form method="POST" style="display: inline;">
                                                            <input type="hidden" name="action" value="' . $action . '">
                                                            <input type="hidden" name="item_id" value="' . $row['id'] . '">
                                                            <button type="submit" class="btn ' . $button_class . ' rounded-pill px-3">
                                                                <i class="fa fa-shopping-bag me-2 ' . $icon_class . '"></i>' . $button_text . '
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="col-12 text-center"><p>No products found.</p></div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Include Footer -->
    <?php include "./partials/footer.php"; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
