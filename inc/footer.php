<?php

$query = "SELECT * FROM settings WHERE id = 1"; // Assuming the data for footer is in the row with id 1
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $logo = $row['logo'];
    $footer_heading = $row['footer_heading'];
    $footer_about = $row['footer_about'];
    $footer_copyright = $row['footer_copyright'];
    $contact_address = $row['contact_address'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
}

?>
<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0"><img src="admin/uploads/<?= $logo  ?>" alt="" style="width: 100px;">
                        </h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3"><?= $footer_heading  ?></h4>
                    <p class="mb-4" style="text-align: justify;"> <?= $footer_about  ?> </p>
                    <!-- <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Shop Info</h4>
                    <a class="btn-link" href="about.php">About Us</a>
                    <a class="btn-link" href="contact.php">Contact Us</a>
                    <!-- <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a> -->


                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Order History</a>
                       
                    </div>
                </div> -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: <?= $contact_address ?></p>
                    <p>Email:<a href="mailto:"> <?= $contact_email ?></a></p>
                    <p>Phone: <a href="tel:+918802621101"> <?= $contact_phone ?></a></p>
                </div>
            </div>
            <?php


            $result = $conn->query("SELECT * FROM social_links WHERE id = 1");
            $row = $result->fetch_assoc();


            ?>

            <div class="col-lg-3">

                <div class="d-flex justify-content-end pt-3">

                    <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href="<?= $row['twitter_link'] ?>"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="<?= $row['facebook_link'] ?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="<?= $row['youtube_link'] ?>"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-secondary btn-md-square rounded-circle" href="<?= $row['linkedin_link'] ?>"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container text-center text-light fs-5">
        <div class="row">
            <p> <?= $footer_copyright ?>&nbsp;<span class="text-danger" style="font-weight: bolder;"><a href="https://www.bhoomitechzone.in/">Developed By BTPL</a></span></p>
        </div>
    </div>
</div>
<!-- Copyright End -->



<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>



<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.5/dist/sweetalert2.min.js"></script>

<!-- Template Javascript -->
<script src="./js/addtocart.js"></script>
<script src="js/main.js"></script>
<!-- SweetAlert2 CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.5/dist/sweetalert2.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery -->


<script>
    AOS.init({
        Duration: 1000,
        offset: 200,
        delay: 100,
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>