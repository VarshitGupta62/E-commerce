<?php

include("admin/config.php");
include("inc/header.php");

?>
<?php
// Get the id from the URL
$subcategory_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
?>


<!---->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>


                    </ul>
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
            <h3>Best-Product</h3>

            <?php
             
            $sql = "SELECT * FROM addproduct WHERE subcategory_id = $subcategory_id AND p_is_active = 1";  // assuming p_is_active means the product is available
            $result = $conn->query($sql);

           
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    // Display product details
                    echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                    echo '<a href="product-details.php?id=' . $product['id'] . '">';
                    echo '<div class="service-item bg-primary rounded border border-primary">';
                    echo '<img style="height: 350px;" src="admin/uploads/' . $product['p_image'] . '" class="img-fluid rounded-top w-100 hover1" alt="">';
                    echo '<div class="px-4 rounded-bottom">';
                    echo '<div class="service-content bg-secondary text-center rounded">';
                    echo '<h5 class="text-white"> </h5>';
                    echo '<h3 class="mb-0">Save Up To 30% off</h3>';
                    echo '</div>';
                    echo '<h6>' . $product['product_name'] . ' - ' . $product['p_qty'] . '<br>';
                    echo '<b>' . $product['P_new_price'] . '</b> <Del>' . $product['p_old_price'] . '</Del></h6>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
            ?>


        </div>
    </div>
</div>
<!-- Featurs End -->


<!-- Vesitable Shop Start-->

<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
  <div class="container py-5">
    <h1 class="mb-0">Best Offers</h1>
    <div class="owl-carousel vegetable-carousel justify-content-center">
      <?php
      // Fetch data from the 'bestoffer' table
      $query = "SELECT * FROM bestoffer";
      $result = mysqli_query($conn, $query); // Ensure $conn is your database connection variable

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $imagePath = "admin/uploads/" . $row['image']; // Assuming images are stored in an 'uploads' folder
          $offerText = $row['offer'];
          echo "
        <div class='border border-primary rounded position-relative vesitable-item'>
            <div class='vesitable-img'>
                <img src='$imagePath' class='img-fluid w-100 rounded-top' alt=''>
            </div>
            <div class='text-white bg-primary p-3 px-3 py-1 rounded position-absolute' style='top: 10px; right: 10px;'>$offerText</div>
        </div>
        ";
        }
      } else {
        echo "<p>No offers available at the moment.</p>";
      }
      ?>
    </div>
  </div>
</div>
<!-- Vesitable Shop End -->

<!-- Vesitable Shop End -->


<!-- Banner Section Start-->
<div class="container-fluid banner my-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="py-4">
                    <h1 class="display-3 text-white">Best Product</h1>
                    <!-- <p class="fw-normal display-3 text-dark mb-4">in Our Store</p> -->
                    <p class="mb-4 text-dark">Experience the pinnacle of comfort and style with our luxury furnishings, crafted to perfection.</p>
                    <!-- <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a> -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="wood-img/hotel-furniture-banner.jpg" class="img-fluid w-100 rounded" alt="">
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
            <h1 class="display-4">Best Products</h1>
            <p>Discover the beauty of our premium wood products, designed for durability and timeless appeal. Crafted with precision, each piece brings natural elegance and warmth to your space.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 col-xl-4">
                <div class="p-2 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="wood-img/icon3.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">6 Seater Dining Table Sets</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 1,075</h4> 
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="wood-img/icon2.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">Beds</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 359</h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="./wood-img/icon12.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">Table Lamps</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 1,325</h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="./wood-img/icon4.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">Sofa Cum Bed</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 1,400</h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="./wood-img/icon6.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">Study Tables</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 320</h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="./wood-img/icon7.jpg" class="img-fluid rounded-circle w-100" alt="">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">Book Shelves</a>
                            <div class="d-flex my-3">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <!-- <h4 class="mb-3">Rs. 1,100</h4>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="text-center" style="border: 2px solid rgb(0, 0, 0); border-radius: 10px;">
                    <img src="Images/sofa-imgs/1...sofas-accent-chairs-rose-gold-boucle-amor-2-seater-sofa.jpg" class="img-fluid rounded" style="width: 100%" alt="">
                    <div class="py-4">
                        <a href="#" class="h5">Sofa-accent-Chairs</a>
                        <div class="d-flex my-3 justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <!-- <h4 class="mb-3">Rs. 2,380</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="text-center" style="border: 2px solid rgb(0, 0, 0); border-radius: 10px;">
                    <img src="Images/sofa-imgs/5sofa.webp" class="img-fluid rounded" style="width: 100%; height: 20% !important; " alt="">
                    <div class="py-4">
                        <a href="#" class="h5">Sofa</a>
                        <div class="d-flex my-3 justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <!-- <h4 class="mb-3">Rs. 1,100</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="text-center" style="border: 2px solid rgb(0, 0, 0); border-radius: 10px;">
                    <img src="Images/sofa-imgs/6sofa.webp" class="img-fluid rounded" alt="">
                    <div class="py-4">
                        <a href="#" class="h5">Sofa-accent-Chairs</a>
                        <div class="d-flex my-3 justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <!-- <h4 class="mb-3">Rs. 690</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="text-center" style="border: 2px solid rgb(0, 0, 0); border-radius: 10px;">
                    <img src="./Images/sofa-imgs/3.2Derek_4.webp" style="width: 100%;" class="img-fluid rounded" alt="">
                    <div class="py-2">
                        <a href="#" class="h5">2 Seater Sofa</a>

                        <div class="d-flex my-3 justify-content-center">
                            <br>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star"></i>
                            <br><br>
                        </div>
                        <!-- <h4 class="mb-3">Rs. 690</h4>
                                <a href="#" class="btn border border-secondary rounded-pill mt-3 mb-3 px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bestsaler Product End -->

<div class="emi_banner">
    <img src="wood-img/emi-banner.jpg" alt="">
</div>



<!-- Fact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="bg-light p-5 rounded">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-secondary"></i>

                        <h4>satisfied customers</h4>
                        <h1>5963+</h1>
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
                        <h1>500+</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fact Start -->



<!-- Testimonials Start -->
<div class="container-fluid testimonial py-5">
  <div class="container py-5">
    <div class="testimonial-header text-center">
      <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
    </div>
    <div class="owl-carousel testimonial-carousel">
      <?php
      // Assuming you have already set up a database connection

      // Query to fetch testimonials
      $query = "SELECT * FROM `testimonials` "; // You can adjust the LIMIT based on your needs
      $result = mysqli_query($conn, $query);

      // Check if there are testimonials
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $clientImage = "uploads/" . $row['client_image']; // Assuming client image is stored in the "uploads" folder
          $clientName = $row['client_name'];
          $clientTitle = $row['client_title'];
      ?>
          <div class="testimonial-item img-border-radius bg-light rounded p-5">
            <div class="position-relative">
              <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 25px; right: 0;"></i>
              <div class="mb-4 pb-4 border-bottom border-secondary">
                <p class="mb-0"><?php echo htmlspecialchars($clientTitle); ?></p>
              </div>
              <div class="d-flex align-items-center flex-nowrap">
                <div class="bg-secondary rounded">
                  <img src="admin/<?php echo htmlspecialchars($clientImage); ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                </div>
                <div class="ms-4 d-block">
                  <h4 class="text-dark"><?php echo htmlspecialchars($clientName); ?></h4>
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
      <?php
        }
      } else {
        echo "<p>No testimonials available.</p>";
      }
      ?>


    </div>
  </div>
</div>
<!-- Tastimonial End -->

<?php

include("inc/footer.php");

?>