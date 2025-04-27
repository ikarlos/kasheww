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
                                    <img src="./img/carousal1.jpg" class="img-fluid w-100 h-100" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Dry Fruites</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="./img/carousal2.jpg" 
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
                                <img src="img/banner1.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Premium Spices</h5>
                                        <h3 class="mb-0">Authentic & Aromatic</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/banner-2.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Gourmet Dry Fruits</h5>
                                        <h3 class="mb-0">Nature's Sweetness</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- <div class="col-md-6 col-lg-4">
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
                    </div> -->
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