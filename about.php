<?php
include("./partials/header.php");
include("./db/db_connection.php");

// Fetch spices from the database
$sql = "SELECT * FROM products WHERE category = 'Spices' LIMIT 3";
$result = $conn->query($sql);
?>

<body>
    <?php
    include("./partials/navbar.php");
    ?>

    <!-- About Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">About Us</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">About</li>
        </ol>
    </div>

    <!-- About Content -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Your Premium Source for Quality Dry Fruits and Spices</h1>
                            <p class="mb-4">We are dedicated to providing the finest quality products to our customers, sourced from the best locations around the world.</p>
                        </div>
                    </div>
                    <!-- Our Story Section -->
                    <div class="about-section bg-white p-4 rounded mb-4">
                        <h2 class="text-primary mb-4">Our Story</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Founded in 2020, Kasheww has emerged as a leading provider of premium quality dry fruits and spices. Our journey began with a simple vision: to bring the finest natural products from around the world to our customers' tables. We believe in the power of nature's bounty and its ability to enhance both health and culinary experiences.</p>
                                <p>At Kasheww, we take pride in our carefully curated selection of products. Our dry fruits are handpicked from the best orchards, our spices are sourced from renowned spice gardens, and our honey is collected from pristine apiaries. Each product in our collection undergoes rigorous quality checks to ensure it meets our high standards.</p>
                                <p>We understand that quality and authenticity are paramount when it comes to natural products. That's why we work directly with farmers and producers who share our commitment to excellence. Our partnerships with local communities not only ensure the best products but also support sustainable farming practices.</p>
                            </div>
                            <div class="col-md-6">
                                <img src="img/about-story.png" alt="Our Story" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>

                    <!-- Our Mission Section -->
                    <div class="about-section bg-white p-4 rounded mb-4">
                        <h2 class="text-primary mb-4">Our Mission</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-box text-center p-4">
                                    <i class="fas fa-leaf fa-3x text-primary mb-3"></i>
                                    <h3 class="h5">Premium Quality</h3>
                                    <p>We never compromise on quality, ensuring that every product meets our high standards. From the finest almonds and cashews to the most aromatic spices and purest honey, we deliver excellence in every product.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box text-center p-4">
                                    <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                                    <h3 class="h5">Customer Satisfaction</h3>
                                    <p>Your satisfaction is our top priority. We go the extra mile to ensure you receive the freshest products, excellent service, and a shopping experience that exceeds expectations.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box text-center p-4">
                                    <i class="fas fa-globe fa-3x text-primary mb-3"></i>
                                    <h3 class="h5">Sustainability</h3>
                                    <p>We're committed to sustainable practices, supporting local communities, and promoting environmentally responsible farming methods. Our products are sourced with respect for nature and local traditions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Our Products Section -->
                    <div class="about-section bg-white p-4 rounded mb-4">
                        <h2 class="text-primary mb-4">Our Products</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="feature-box text-center p-4">
                                    <i class="fas fa-apple-alt fa-3x text-primary mb-3"></i>
                                    <h3 class="h5">Dry Fruits</h3>
                                    <p>Premium quality almonds, cashews, walnuts, raisins, and more. Each piece is carefully selected for its size, taste, and nutritional value.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-box text-center p-4">
                                    <i class="fas fa-pepper-hot fa-3x text-primary mb-3"></i>
                                    <h3 class="h5">Spices</h3>
                                    <p>Authentic spices from around the world, including premium cinnamon, cardamom, black pepper, and specialty blends.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "partials/footer.php"; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html> 