<?php

include("inc/header.php");

?>

<?php

$query = "SELECT * FROM settings WHERE id = 1"; // Assuming the data for footer is in the row with id 1
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $contact_address = $row['contact_address'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
}

?>


<!-- SweetAlert2 CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.5/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.5/dist/sweetalert2.min.css" rel="stylesheet"> -->


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
    <h1 class="text-center text-white display-6" style="color: aliceblue !important;">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                        <p class="mb-4">Dakshayni Handicraft specializes in intricately crafted wooden items, blending traditional artistry with modern designs. Their products, made from high-quality wood, reflect craftsmanship and attention to detail. Ideal for home décor, gifting, or functional purposes, each piece showcases the beauty and durability of wood. <a href="about.php">Read More</a>.</p>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100"
                            style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d900078.5637358995!2d72.7794445364179!3d28.20938185595889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWARD%20NO.%2003%2C%20THUKRIYASAR%2C%20TEH%20%20DUNGARGARH%20BIKANER%2C%20RAJASTHAN%2C%C2%A0334001!5e0!3m2!1sen!2sin!4v1731480026128!5m2!1sen!2sin"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form id="contactDataSubmit">
                        <input type="text" name="contact_name" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
                        <input type="email" name="contact_email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
                        <textarea name="contact_message" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message"></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2"><?= $contact_address ?></p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">
                                <a href="mailto:<?= htmlspecialchars($contact_email) ?>"><?= htmlspecialchars($contact_email) ?></a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2"><a href="tel:<?= $contact_phone ?>"><?= $contact_phone ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php

include("inc/footer.php");

?>



<script>
    $('#contactDataSubmit').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: 'admin/query.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // alert(response);
                if (response == 1) {
                    // Reset the form and show success message
                    $('#contactDataSubmit').trigger('reset');
                    // alert("data submited")
                    Swal.fire({
                        title: "Success!",
                        text: "Your message details successfully send.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                } else {
                    // Show failure message
                    Swal.fire({
                        title: "Failed!",
                        text: "Failed to add your contact details. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function(err) {
                console.log(err);
                Swal.fire({
                    title: "Error!",
                    text: "There was an error processing your request. Please check your network or try again later.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    });
</script>