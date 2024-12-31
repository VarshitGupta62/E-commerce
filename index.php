<?php

include("inc/header.php");
include("admin/query.php");



// Fetch the latest 16 items
$query = "SELECT * FROM media ORDER BY id DESC LIMIT 16"; // Adjust the table and column names
$result = $conn->query($query);

$products = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}

// Split into two rows
$row1 = array_slice($products, 0, 8);
$row2 = array_slice($products, 8, 8);

?>



<!-- Navbar End -->
<style>
  /* General container and scrolling rows */
  .product-scroll-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  /* Rows for horizontal scrolling */
  .product-row {
    display: flex;
    overflow-x: auto;
    scrollbar-width: thin;
    /* For modern browsers */
  }

  .product-row::-webkit-scrollbar {
    height: 8px;
    /* Horizontal scrollbar height */
  }

  .product-row::-webkit-scrollbar-thumb {
    background-color: #ccc;
    /* Color of scrollbar */
    border-radius: 4px;
    /* Rounded scrollbar edges */
  }

  /* Product card styling */
  .product-card {
    min-width: 146px;
    /* Ensure consistent size for cards */
    max-width: 150px;
    flex-shrink: 0;
    /* Prevent shrinking */
  }

  .product-card a {
    text-decoration: none;
    color: inherit;
  }

  .product-img {
    width: 100px;
    height: 100px;
    object-fit: cover;

  }

  .product-img:hover {
    transform: scale(1.1);
    /* Zoom effect on hover */
  }

  .product-title {
    margin-top: 10px;
    font-size: 1rem;
    font-weight: bold;
    color: #333;
    text-align: center;
  }

  .product-card {
    margin-right: 150px;
    /* Adjust the margin as needed */
    text-align: center;
  }
</style>


<!-- Bestsaler Product Start -->



<div class="container-fluid py-5">
  <div class="container py-5">
    <div class="text-center mx-auto mb-5" style="max-width: 800px; margin-top: 180px;">
      <h1 class="display-4">Best Products</h1>
    </div>

    <div class="product-scroll-container">
      <!-- Row 1 -->
      <div class="product-row row-1 d-flex overflow-auto">
        <?php foreach ($row1 as $product): ?>
          <div class="product-card text-center mx-2">
            <a href="product.php?id=<?= $product['subcategory']; ?>">
              <img src="admin/uploads/<?= $product['Image']; ?>" class="product-img rounded-circle" alt="<?= $product['Title']; ?>">
              <p class="product-title"><?= $product['Title']; ?></p>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Row 2 -->
      <div class="product-row row-2 d-flex overflow-auto mt-4">
        <?php foreach ($row2 as $product): ?>
          <div class="product-card text-center mx-2">
            <a href="product.php?id=<?= $product['id']; ?>">
              <img src="admin/uploads/<?= $product['Image']; ?>" class="product-img rounded-circle" alt="<?= $product['Title']; ?>">
              <p class="product-title"><?= $product['Title']; ?></p>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>



  </div>
</div>




<!-- Bestsaler Product End -->


<div class="emi_banner">
  <img src="wood-img/emi-banner.jpg" alt="">
</div>






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
              <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-id="all" data-bs-toggle="pill">
                <span class="text-dark" style="width: 200px;">All Products</span>
              </a>
            </li>
            <?php
            $query = "
                  SELECT DISTINCT ap.subcategory_id, s.subcategory_name 
                  FROM active_product ap
                  JOIN subcategory s ON ap.subcategory_id = s.id
                  WHERE ap.status = 1
                ";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              $subcategoryName = htmlspecialchars($row['subcategory_name']);
              $subcategoryId = htmlspecialchars($row['subcategory_id']);
              echo "
                        <li class='nav-item'>
                            <a class='d-flex py-2 m-2 bg-light rounded-pill' data-id='$subcategoryId' data-bs-toggle='pill'>
                                <span class='text-dark' style='width: 180px;'>$subcategoryName</span>
                            </a>
                        </li>";
            }
            ?>
          </ul>
        </div>
      </div>
      <div id="productContainer" class="row g-4"></div>
    </div>
  </div>
</div>
<!-- Fruits Shop End-->


<!-- Featurs Start -->

<!-- Featurs End -->


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
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Banner Section End -->



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

<script>
  $(document).ready(function() {
    // Load products for the default tab on page load
    loadProducts("all");

    // Event listener for tab clicks
    $(".nav-pills a").click(function(e) {
      e.preventDefault(); // Prevent default link behavior

      const subcategoryId = $(this).data("id"); // Get the data-id value
      $(".nav-pills a").removeClass("active"); // Remove active class from all tabs
      $(this).addClass("active"); // Add active class to the clicked tab

      loadProducts(subcategoryId); // Load products for the selected tab
    });

    // Function to load products via AJAX
    function loadProducts(subcategoryId) {
      $("#productContainer").html('<p>Loading...</p>'); // Show loading text

      $.ajax({
        url: "admin/query.php",
        type: "POST",
        data: {
          subcategory_id: subcategoryId
        },
        success: function(response) {
          $("#productContainer").html(response); // Render the response
        },
        error: function() {
          Swal.fire("Error!", "Failed to fetch products.", "error");
        },
      });
    }
  });
</script>