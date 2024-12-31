<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");
?>

<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="true">Logo</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="favicon-tab" data-bs-toggle="tab" data-bs-target="#favicon" type="button" role="tab" aria-controls="favicon" aria-selected="false">Favicon</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer" type="button" role="tab" aria-controls="footer" aria-selected="false">Footer & Contact</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="false">Message Settings</button>
            </li> -->
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="productTabContent">
            <!-- Logo Tab -->
            <div class="tab-pane fade show active" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                <div class="card card-body py-3">
                    <form id="logoDataUpdate">
                        <div class="card-body">
                            <!-- <div class="alert bg-success-subtle text-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center text-success">
                                    <i class="ti ti-info-circle me-2 fs-4"></i>
                                    Update the logo of your site below.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label>
                                <div class="text-center">
                                    <img src='' id="currentLogoImage" class="img-fluid rounded" alt="Image not found" style="max-height: 200px; width: auto;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="new-logo" class="form-label">New Logo</label>
                                <input type="file" name="logo" id="new-logo" class="form-control">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Favicon Tab -->
            <div class="tab-pane fade" id="favicon" role="tabpanel" aria-labelledby="favicon-tab">
                <div class="card card-body py-3">
                    <form id="faviconDataUpdate">
                        <div class="card-body">
                            <!-- <div class="alert bg-success-subtle text-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center text-success">
                                    <i class="ti ti-info-circle me-2 fs-4"></i>
                                    Update the favicon of your site below.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label">Current Favicon</label>
                                <div class="text-center">
                                    <img src='' id="currentFaviconImage" class="img-fluid rounded" alt="Image not found" style="max-height: 100px; width: auto;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="new-favicon" class="form-label">New Favicon</label>
                                <input type="file" name="favicon" id="new-favicon" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Tab -->
            <div class="tab-pane fade" id="footer" role="tabpanel" aria-labelledby="footer-tab">
                <div class="card card-body py-3">
                    <form id="footerDataUpdate">
                        <div class="card-body">
                            <!-- <div class="alert bg-success-subtle text-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center text-success">
                                    <i class="ti ti-info-circle me-2 fs-4"></i>
                                    Update footer information and contact details.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> -->
                            <div class="mb-3">
                                <label for="footer-copyright" class="form-label">Footer Heading</label>
                                <input type="text" name="footer_heading" id="footer-copyright" class="form-control footer_heading">
                            </div>
                            <div class="mb-3">
                                <label for="footer-about" class="form-label">Footer About</label>
                                <textarea name="footer_about" id="footer-about" class="form-control footer_about" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="footer-copyright" class="form-label">Footer Copyright</label>
                                <input type="text" name="footer_copyright" id="footer-copyright" class="form-control footer_copyright">
                            </div>
                            <div class="mb-3">
                                <label for="footer-about" class="form-label">Contact Address</label>
                                <textarea name="footer_contact_address" id="footer-about" class="form-control footer_contact_address" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="footer-copyright" class="form-label">Contact Phone Number</label>
                                <input type="text" name="footer_contact_phone_number" id="footer-copyright" class="form-control footer_contact_phone_number">
                            </div>
                            <div class="mb-3">
                                <label for="footer-copyright" class="form-label">Contact Email</label>
                                <input type="text" name="footer_contact_email" id="footer-copyright" class="form-control footer_contact_email">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Message Tab -->
            <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                <div class="card card-body py-3">
                    <form id="messageDataUpdate">
                        <div class="card-body">
                            <!-- <div class="alert bg-success-subtle text-success alert-dismissible fade show" role="alert">
                                <div class="d-flex align-items-center text-success">
                                    <i class="ti ti-info-circle me-2 fs-4"></i>
                                    Configure message settings below.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> -->
                            <div class="mb-3">
                                <label for="footer-copyright" class="form-label">Contact Email Address</label>
                                <input type="text" name="footer_heading" id="footer-copyright" class="form-control footer_heading">
                            </div>
                            <div class="mb-3">
                                <label for="footer-about" class="form-label">Contact Email Subject</label>
                                <textarea name="footer_about" id="footer-about" class="form-control footer_about" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="thank-you-message" class="form-label">Thank You Message</label>
                                <textarea name="thank_you_message" id="thank-you-message" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("inc/footer.php"); ?>
<script>
    // Function to load logo data
    function loadLogoData() {
        // alert("logo is loading");
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadLogoData: 1
            },
            success: function(response) {
                // alert(data);
                let data = JSON.parse(response);
                $("#currentLogoImage").attr("src", "uploads/" + data);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load logo data.", "error");
            }
        });
    }
    loadLogoData();

    function loadFooterData() {
        // alert("logo is loading");
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadFooterData: 1
            },
            success: function(response) {
                // alert(response);
                let data = JSON.parse(response);
                $('.footer_heading').val(data.footer_heading);
                $('.footer_about').val(data.footer_about);
                $('.footer_copyright').val(data.footer_copyright);
                $('.footer_contact_address').val(data.contact_address);
                $('.footer_contact_phone_number').val(data.contact_phone);
                $('.footer_contact_email').val(data.contact_email);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load logo data.", "error");
            }
        });
    }
    loadFooterData();


    function loadFaviconData() {
        // alert("logo is loading");
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadFaviconData: 1
            },
            success: function(response) {
                let data = JSON.parse(response);
                $("#currentFaviconImage").attr("src", "uploads/" + data);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load logo data.", "error");
            }
        });
    }
    loadFaviconData();
    // Submit handler for logo update form
    $("#logoDataUpdate").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    $("#logoDataUpdate").trigger("reset");
                    Swal.fire("Success!", "Logo updated successfully.", "success");
                    loadLogoData();
                } else {
                    Swal.fire("Error!", "Failed to update logo.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    // Submit handler for favicon update form
    $("#faviconDataUpdate").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    $("#faviconDataUpdate").trigger("reset");
                    Swal.fire("Success!", "Favicon updated successfully.", "success");
                    loadFaviconData();
                } else {
                    Swal.fire("Error!", "Failed to update favicon.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    // Submit handler for footer data update form
    $("#footerDataUpdate").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    
                    Swal.fire("Success!", "Footer data updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update footer data.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    // Submit handler for message settings update form
    $("#messageDataUpdate").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    $("#messageDataUpdate").trigger("reset");
                    Swal.fire("Success!", "Message settings updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update message settings.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });
</script>