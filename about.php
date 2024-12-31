<?php

include("inc/header.php");

// Fetch data from the database
$query = "SELECT * FROM about_section WHERE id = 1";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_images = $row['about_image']; // Assuming this contains JSON or comma-separated values
}

// Decode the images from JSON or split by comma
$image_array = explode(',', $about_images); // Use `json_decode($about_images, true)` if it's JSON

?>

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
    <h1 class="text-center text-white display-6" style="color: aliceblue !important;">About Us</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="about.html">About</a></li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- About Us Start -->
<div class="about-section">
    <div class="container1">
        <h1>About Us</h1>
        <p class="intro"><?= $about_title ?></p>
        <div class="content">
            <div class="image-section">
                <?php foreach ($image_array as $image): ?>
                    <img src="admin/uploads/<?= trim($image) ?>" alt="About Us Image">
                    <br><br>
                <?php endforeach; ?>
            </div>
            <div class="text-section">
                <?= $about_content ?>
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

<?php
include("inc/footer.php");
?>
