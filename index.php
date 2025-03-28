<?php
include("./partials/header.php");


?>


    <body>

      <?php
include("./partials/navbar.php");

      ?>

        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Pure & Natural</h4>
                        <h1 class="mb-5 display-3 text-primary">Manufacturers and Exporters Of Premium Spices, Dry Fruits & Superfoods</h1>
                       
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="data:image/jpeg;base64,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" 
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Dry Fruites</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="data:image/jpeg;base64,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" 
                                    class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Spicies</a>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Featurs Section Start -->
     <!-- Features Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-6 col-md-6">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Featurs Section End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Our Organic Products</h1>
                        </div>
                        <div class="col-lg-8 text-end">

                        <?php 
                         $sql = "SELECT DISTINCT category FROM products";
                         $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo '<ul class="nav nav-pills d-inline-flex text-center mb-5">';
                          
                                $i=0;
                                
                                // Loop through each unique category
                                while($row = $result->fetch_assoc()) {
                                    $category = $row['category'];
                                    echo '<li class="nav-item">';
                                    if($i===0){
                                        echo '<a class="d-flex py-2 m-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-' . $category . '">';

                                    }else{
                                        echo '<a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-' . $category . '">';

                                    }
                                    echo '<span class="text-dark" style="width: 130px;">' . $category . '</span>';
                                    echo '</a>';
                                    echo '</li>';
                                    $i++;
                                }
                
                                echo '</ul>';
                            } else {
                                echo "No categories found";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                <div class="tab-content">
                    <?php
                      $categoryQuery = "SELECT DISTINCT category FROM products";
                      $resultCategory = $conn->query($categoryQuery);
                      $i=0;
                      while($rowCategory = $resultCategory->fetch_assoc()) {
                        $category = $rowCategory['category'];
                        

                    // Fetch products from the database
                    $sql = "SELECT * FROM products WHERE category='$category' ";
                    $result = $conn->query($sql);

                    if($i===0){
                        echo '<div id="tab-' . $category . '" class="tab-pane fade show p-0 active">';
                    }else{
                        echo '<div id="tab-' . $category . '" class="tab-pane fade show p-0">';
                    }
                    $i++;
                    echo '<div class="row g-4">';
                    if ($result->num_rows > 0) {
                        
                        // Display products in tab content
                        
                        while($row = $result->fetch_assoc()) {
                            
                            echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                            echo '<div class="rounded position-relative fruite-item">';
                            echo '<div class="fruite-img">';
                            echo '<img src="img/' . $row['image'] . '" class="img-fluid w-100 rounded-top" alt="">';
                            echo '</div>';
                            echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $row['category'] . '</div>';
                            echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                            echo '<h4>' . $row['name'] . '</h4>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                            echo '<p class="text-dark fs-5 fw-bold mb-0">$' . $row['price'] . ' / kg</p>';
                            echo '<a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            }
                            } else {
                                echo "No products found";
                                }
                                echo '</div>';
                                echo '</div>';

                      }
                    ?>
                </div>
            </div>
        </div>
                </div>      
            </div>
        </div>
        <!-- Fruits Shop End-->


        <!-- Featurs Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Apples</h5>
                                        <h3 class="mb-0">20% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Tasty Fruits</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Exotic Vegitable</h5>
                                        <h3 class="mb-0">Discount 30$</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->


        <!-- Vesitable Shop Start-->
        <!-- Spices Shop Start-->
        <div class="container-fluid vesitable py-5">
            <div class="container py-5">
                <h1 class="mb-0">Fresh Organic Spices</h1>
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <?php
                    // Fetch spice products from the database
                    $sql = "SELECT * FROM products WHERE category = 'Spices'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="border border-primary rounded position-relative vesitable-item">';
                            echo '<div class="vesitable-img">';
                            echo '<img src="img/' . $row['image'] . '" class="img-fluid w-100 rounded-top" alt="' . $row['name'] . '">';
                            echo '</div>';
                            echo '<div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Spices</div>';
                            echo '<div class="p-4 rounded-bottom">';
                            echo '<h4>' . $row['name'] . '</h4>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                            echo '<p class="text-dark fs-5 fw-bold mb-0">$' . $row['price'] . ' / kg</p>';
                            echo '<a href="shop-detail.php?id=' . $row['id'] . '" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="text-center">No spice products found</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Spices Shop End-->


        <!-- Vesitable Shop End -->


        <!-- Banner Section Start-->
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Fresh Exotic Dry Fruits & Spices</h1>
                            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                            <p class="mb-4 text-dark">At The Kasheww Store, we take pride in being trusted exporters of premium-quality Kashmiri dry fruits, spices, and superfoods. Sourced directly from the pristine farms and valleys of Kashmir, our products are known for their authenticity, purity, and rich natural flavors.</p>
                            <a href="./shop.php" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="img/image.jpg" class="img-fluid w-100 rounded" alt="">
                            <!-- <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <h1 style="font-size: 100px;">1</h1>
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">50$</span>
                                    <span class="h4 text-muted mb-0">kg</span>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->


        <!-- Bestsaler Product Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                    <h1 class="display-4">Bestseller Products</h1>
                    <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                </div>
                <div class="row g-4">
                    <?php
                    $sql = "SELECT * FROM products LIMIT 6";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <img src="img/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid rounded-circle w-100" alt="<?php echo htmlspecialchars($row['name']); ?>">
                                </div>
                                <div class="col-6">
                                    <a href="shop-detail.php?id=<?php echo $row['id']; ?>" class="h5"><?php echo htmlspecialchars($row['name']); ?></a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3">$<?php echo htmlspecialchars($row['price']); ?></h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(<?php echo $row['id']; ?>)"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
        <!-- Bestsaler Product End -->


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>satisfied customers</h4>
                                <h1>1963</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality of service</h4>
                                <h1>99%</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality certificates</h4>
                                <h1>33</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Available Products</h4>
                                <h1>789</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Our Testimonial</h4>
            <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <!-- Testimonial 1 -->
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                    <div class="mb-4 pb-4 border-bottom border-secondary">
                        <p class="mb-0">"The premium almonds and cashews I ordered arrived fresh and perfectly packed. The quality is unmatched compared to local stores, and the prices are reasonable for such premium dry fruits. Will definitely order again!"</p>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-secondary rounded">
                            <img src="img/user.png" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">Rahul Sharma</h4>
                            <p class="m-0 pb-3">Health Enthusiast</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                    <div class="mb-4 pb-4 border-bottom border-secondary">
                        <p class="mb-0">"As a chef, I'm very particular about spices. The cardamom and saffron I purchased here are incredibly aromatic and fresh. They've elevated my dishes to a whole new level. Fast delivery and excellent customer service too!"</p>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-secondary rounded">
                            <img src="img/user.png" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">Priya Patel</h4>
                            <p class="m-0 pb-3">Professional Chef</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                    <div class="mb-4 pb-4 border-bottom border-secondary">
                        <p class="mb-0">"I've been buying my monthly stock of walnuts and dates from here for my family. The products are always fresh, well-packed, and full of flavor. My kids love the organic figs! Highly recommend for quality dry fruits."</p>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-secondary rounded">
                            <img src="img/user.png" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">Ananya Gupta</h4>
                            <p class="m-0 pb-3">Homemaker</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Tastimonial End -->


       <?php  
       include ("./partials/footer.php");

       ?>