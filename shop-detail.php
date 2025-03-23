    <?php include "./partials/header.php"; ?>
    <?php
    session_start();
    include "./db/db_connection.php";

    // Check if the product ID is provided in the URL
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $product_id = $_GET["id"]; // Get the product ID from the query parameter
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id); // Bind the product ID to the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the product exists
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc(); // Fetch the product details as an associative array
        } else {
            // Redirect or show an error if the product is not found
            header("Location: 404.php"); // Redirect to a 404 page
            exit();
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // Redirect or show an error if no product ID is provided
        header("Location: 404.php"); // Redirect to a 404 page
        exit();
    }
    ?>
    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <?php include "./partials/navbar.php"; ?>

        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <!-- Product Image -->
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="<?= htmlspecialchars(
                                            str_replace(
                                                "../uploads/",
                                                "./uploads/",
                                                $product["image"]
                                            )
                                        ) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars(
    $product["name"]
) ?>">
                                    </a>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?= htmlspecialchars(
                                    $product["name"]
                                ) ?></h4>
                                <p class="mb-3">Category: <?= htmlspecialchars(
                                    $product["category"]
                                ) ?></p>
                                <h5 class="fw-bold mb-3">$<?= htmlspecialchars(
                                    $product["price"]
                                ) ?> / kg</h5>
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <p class="mb-4"><?= htmlspecialchars(
                                    $product["description"]
                                ) ?></p>

                                <!-- Quantity Input -->
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Add to Cart Button -->
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                </a>
                            </div>

                            <!-- Product Tabs (Description and Reviews) -->
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <!-- Description Tab -->
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p><?= htmlspecialchars(
                                            $product["description"]
                                        ) ?></p>
                                    </div>

                                    <!-- Reviews Tab -->
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        <div class="d-flex">
                                            <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Jason Smith</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                        <!-- Add more reviews here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Section (Categories, Featured Products, etc.) -->
                    <div class="col-lg-4 col-xl-3">
                        <!-- Sidebar content here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->


    <?php include "./partials/footer.php"; ?>
