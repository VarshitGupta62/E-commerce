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
                <button class="nav-link active" id="Home-tab" data-bs-toggle="tab" data-bs-target="#Home" type="button" role="tab" aria-controls="Home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="false">About</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="favicon-tab" data-bs-toggle="tab" data-bs-target="#favicon" type="button" role="tab" aria-controls="favicon" aria-selected="false">Contact</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="productTabContent">
            <!-- Logo Tab -->
            <div class="tab-pane fade show active" id="Home" role="tabpanel" aria-labelledby="Home-tab">
                <div class="card card-body py-3">
                    <h4 class="card-title mb-6" style="text-align: center;">Add Best Porduct</h4>
                    <form id="BestPorduct" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="subcategory-id" class="form-label">Subcategory</label>
                                <select name="subcategory_id" id="subcategory-id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="home_image" class="form-label">Image</label>
                                <input type="file" name="home_image" id="home_image" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="home_title" class="form-label">Title</label>
                                <input type="text" name="home_title" id="home_title" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card card-body py-3">
                    <div class="card w-100 position-relative overflow-hidden">
                        <div class="px-4 py-3 ">
                            <h4 class="card-title mb-0">All Best Porduct</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Sr.N</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Sub-Category</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Image</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Title</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Edit</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Delete</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadHomeData">

                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="card card-body py-3">
                    <h4 class="card-title mb-6" style="text-align: center;">Add Best Offers</h4>
                    <form id="bestofferdatasubmit">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="home_bestoffer_image" class="form-control  ">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Offer</label>
                                <input type="text" name="home_bestoffer_offer" class="form-control  ">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-body py-3">
                    <div class="card w-100 position-relative overflow-hidden">
                        <div class="px-4 py-3 ">
                            <h4 class="card-title mb-0">All Best Offers</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Sr.N</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Image</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Offer</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Edit</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Delete</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadBestOfferData">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-body py-3">
                    <h4 class="card-title mb-6" style="text-align: center;">Add Testimonial </h4>
                    <form id="AddTestimonialForm">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Client Image</label>
                                <input type="file" name="client_image" class="form-control  ">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Client Name</label>
                                <input type="text" name="client_name" class="form-control  ">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Client Description</label>
                                <textarea name="client_title" class="form-control" rows="5" ></textarea>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card card-body py-3">
                    <div class="card w-100 position-relative overflow-hidden">
                        <div class="px-4 py-3 ">
                            <h4 class="card-title mb-0">All Testimonial</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Sr.N</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Client Image</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Client Name</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Client Description</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Delete</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="testimonialTableBody">

                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>




            <div class="tab-pane fade " id="logo" role="tabpanel" aria-labelledby="logo-tab">
                <div class="card card-body py-3">
                    <form id="AboutSectiondata">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Page Title</label>
                                <textarea name="about_title" id="footer-copyright" class="form-control footer_heading about_title" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Page Content</label>
                                <div class="mb-3">
                                    <div id="snow-editor-new" style="height: 300px;">
                                    </div>
                                </div>
                            </div>

                            <div class="email-repeater mb-3">
                                <div data-repeater-list="repeater-group">
                                    <div class="email-repeater2 mb-3">
                                        <!-- <label class="form-label">Page Images</label>
                                        <input type="file" name="about_images[]" class="form-control mb-3" multiple> -->
                                    </div>
                                </div>
                                <button type="button" data-repeater-create="" class="btn btn-success hstack gap-6">
                                    Add More File
                                </button>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="favicon" role="tabpanel" aria-labelledby="favicon-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="datatables">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h4 class="card-title mb-0">All Contact US</h4>
                                    </div>
                                    <div class="table-responsive" style="max-height: 400px; overflow-x: auto; overflow-y: auto;">
                                        <table id="data_show" class="table table-striped table-bordered display">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Message</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="loadContactAllData">

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include("inc/footer.php"); ?>
<script>
    $(document).ready(function() {
        $('#data_show').DataTable({

            responsive: true,
            lengthMenu: [10, 25, 50, 100], // Options for the number of rows to show
            pageLength: 10 // Default number of rows displayed
        });
    });

    function loadSubcategories() {
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadSubcategories: 1
            },
            success: function(data) {
                // alert(data);
                $("#subcategory-id").html("<option value=''>Select Subcategory</option>" + data);
                $("#subcategory-id2").html("<option value=''>Select Subcategory</option>" + data);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load subcategories.", "error");
            }
        });
    }
    loadSubcategories();
</script>

<!------------------------------------ home page model for edit-------------------------------->

<div class="modal fade" id="product-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Best Product</h4>
                <button type="button" class="btn-close editmodelclose close" data-bs-dismiss="modal"></button>
            </div>
            <form id="UpdateOfferForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Image -->

                    <div class="mb-3">
                        <label for="subcategory-id" class="form-label">Subcategory</label>
                        <select name="new_subcategory_id" id="subcategory-id2" class="form-control select2">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Image</label> <!-- Show current About image -->
                        <div class="text-center">
                            <img src='' class="carouselImage img-fluid rounded border" alt='Image not found' id="currentAboutImage" style="max-height: 200px; width: auto;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="product-image" class="form-label">New Image</label>
                        <input type="file" name="newHomeImage" id="product-image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="home_title" class="form-label">Title</label>
                        <input type="text" name="newBestOfferTitle" id="home_title" class="form-control newBestOfferTitle" required>
                    </div>
                </div>

                <input type="hidden" name="blogOfferEditFormId" id="blogOfferEditFormId">

                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Save Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!---------------------------------------------------- model offer ------------------------------------------>

<div class="modal fade" id="offer-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Best Offer</h4>
                <button type="button" class="btn-close editmodelclose close" data-bs-dismiss="modal"></button>
            </div>
            <form id="UpdateBestOfferForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Current Image</label> <!-- Show current About image -->
                        <div class="text-center">
                            <img src='' class="carouselImage2 img-fluid rounded border" alt='Image not found' id="currentAboutImage" style="max-height: 200px; width: auto;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="product-image" class="form-label">New Image</label>
                        <input type="file" name="new_home_bestoffer_image" id="product-image" class="form-control new_home_bestoffer_image">
                    </div>

                    <div class="mb-3">
                        <label for="home_title" class="form-label">Title</label>
                        <input type="text" name="new_home_bestoffer_offer" id="home_title" class="form-control new_home_bestoffer_offer" required>
                    </div>
                </div>

                <input type="hidden" name="bestOfferEditFormId" id="bestOfferEditFormId">

                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!------------------------------------- Testimonel Section ------------------------------------------>

<div class="modal fade" id="testimonel-modal-edit editModal" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Testimonel</h4>
                <button type="button" class="btn-close editmodelclose close" data-bs-dismiss="modal"></button>
            </div>
            <form id="EditTestimonialForm">
                <div class="modal-body">
                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Current Image</label> <!-- Show current About image -->
                        <div class="text-center">
                            <img src='' class="carouselImage3 img-fluid rounded border" alt='Image not found' id="currentAboutImage" style="max-height: 200px; width: auto;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Client Image</label>
                        <input type="file" name="new_client_image" class="form-control  ">
                    </div>
                    <div class="mb-3">
                        <label for="about-title" class="form-label">Client Name</label>
                        <input type="text" name="new_client_name" class="form-control  new_client_name">
                    </div>
                    <div class="mb-3">
                        <label for="about-title" class="form-label">Client Title</label>
                        <input type="text" name="new_client_title" class="form-control  new_client_title">
                    </div>
                </div>

                <input type="hidden" name="TestimonialData" id="EditTestimonialId">

                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add Testimonial
    $("#AddTestimonialForm").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // alert(response);
                if (response == 1) {
                    $("#AddTestimonialForm").trigger("reset");
                    loadTestimonialData();
                    Swal.fire("Success!", "Testimonial added successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to add testimonial.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            },
        });
    });

    // Load Testimonials
    function loadTestimonialData() {
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadTestimonialData: true
            },
            success: function(response) {
                $("#testimonialTableBody").html(response);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load testimonials.", "error");
            },
        });
    }
    loadTestimonialData();

    // Delete Testimonial
    $(document).on("click", ".DeleteTestimonial", function() {
        let testimonialId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the testimonial.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        deleteTestimonialById: testimonialId
                    },
                    success: function(response) {
                        if (response == 1) {
                            loadTestimonialData();
                            Swal.fire("Deleted!", "The testimonial has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete the testimonial.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred.", "error");
                    },
                });
            }
        });
    });

    // Edit Testimonial
    $(document).on("click", ".EditTestimonial", function() {
        let testimonialId = $(this).data("id");

        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadTestimonialEditForm: testimonialId
            },
            success: function(data) {

                // alert(data);
                data = JSON.parse(data);
                $("#EditTestimonialId").val(data.id);
                $(".new_client_name").val(data.client_name);
                $(".new_client_title").val(data.client_title);
                $('.carouselImage3').attr('src', 'uploads/' + data.client_image);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load testimonial details.", "error");
            },
        });
    });

    // Update Testimonial
    $("#EditTestimonialForm").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // alert(response);
                if (response == 1) {
                    $("#EditTestimonialForm").trigger("reset");
                    $("#editModal").modal("hide");
                    loadTestimonialData();
                    Swal.fire("Success!", "Testimonial updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update testimonial.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            },
        });
    });
</script>



<!------------------------------------- home page section ------------------------------------------>

<script>
    $("#BestPorduct").on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);


        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                console.log(response);

                // alert(response);
                if (response == 1) {

                    $("#BestPorduct").trigger("reset");
                    loadHomeData();
                    Swal.fire("Success!", "Best Product Added successfully.", "success");

                } else {
                    Swal.fire("Error!", "Failed to Added Best Product.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    function loadHomeData() {
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadHomeData: true
            },
            success: function(response) {


                $('#loadHomeData').html(response);

            },
            error: function() {
                Swal.fire("Error!", "Failed to fetch about section data.", "error");
            }
        });
    }
    loadHomeData();

    $(document).on("click", ".HomeDeleteById", function() {


        var imageId = $(this).data("id");
        var deleteimg = $(this).data("deleteimg");



        Swal.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the image.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        deleteHomeImageById: imageId,
                        imageItem: deleteimg
                    },
                    success: function(response) {
                        // alert(response);
                        if (response == 1) {
                            loadHomeData();
                            Swal.fire("Deleted!", "The image has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete the image.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred.", "error");
                    }
                });
            }
        });
    });
    $(document).on('click', '.HomeBlogEditById', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadBlogOfferEditForm: id
            },
            success: function(data) {
                // alert(data);
                data = JSON.parse(data);
                $('#blogOfferEditFormId').val(data.id);
                $('.newBestOfferTitle').val(data.Title);
                $('.select2').val(data.subcategory);
                $('.carouselImage').attr('src', 'uploads/' + data.Image);
            }
        });
    });
    $('#UpdateOfferForm').on('submit', function(e) {
        e.preventDefault();
        let formdata = new FormData(this);

        // alert("button click");
        $.ajax({
            url: "query.php",
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {

                // alert("Server Response: " + data);
                if (data == 1) {
                    alert("Updated Successfully");
                    $('#UpdateOfferForm').trigger('reset');
                    $('.close').click();
                    loadHomeData();
                } else {
                    alert("Failed to update");
                }
            }
        })
    });
</script>
<!---------------------------------best offer show section ----------------------------------- -->

<script>
    $("#bestofferdatasubmit").on("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        // alert("best offer button click");


        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {


                // alert(response);
                if (response == 1) {

                    $("#bestofferdatasubmit").trigger("reset");
                    Swal.fire("Success!", "Best Offer Added successfully.", "success");
                    loadBestOfferData();

                } else {
                    Swal.fire("Error!", "Failed to Added Best Offer+.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    function loadBestOfferData() {
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadBestOfferData: true
            },
            success: function(response) {


                $('#loadBestOfferData').html(response);

            },
            error: function() {
                Swal.fire("Error!", "Failed to fetch about section data.", "error");
            }
        });
    }
    loadBestOfferData();

    $(document).on("click", ".HomeOfferDeleteById", function() {


        var imageId = $(this).data("id");
        var deleteimg = $(this).data("deleteimg");

        Swal.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the image.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        deleteHomeImageById: imageId,
                        imageItem: deleteimg
                    },
                    success: function(response) {
                        // alert(response);
                        if (response == 1) {
                            loadHomeData();
                            Swal.fire("Deleted!", "The Offer has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete the Offer.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred.", "error");
                    }
                });
            }
        });
    });
    $(document).on('click', '.HomeBestOfferEditById', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadBestOfferEditForm: id
            },
            success: function(data) {
                // alert(data);
                data = JSON.parse(data);
                $('#bestOfferEditFormId').val(data.id);
                $('.new_home_bestoffer_offer').val(data.offer);
                $('.carouselImage2').attr('src', 'uploads/' + data.image);
            }
        });
    });
    $('#UpdateBestOfferForm').on('submit', function(e) {
        e.preventDefault();
        let formdata = new FormData(this);

        // alert("button click");
        $.ajax({
            url: "query.php",
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {

                // alert("Server Response: " + data);
                if (data == 1) {
                    alert("Updated Successfully");
                    $('#UpdateBestOfferForm').trigger('reset');
                    $('.close').click();
                    loadBestOfferData();
                } else {
                    alert("Failed to update");
                }
            }
        })
    });
</script>

<!------------------------------------------ about page section  -------------------------------->

<script>
    function loadAllData() {
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadAboutData: true
            },
            success: function(response) {
                // alert(response);
                var data = JSON.parse(response);

                // alert(data.about_title);

                // Populate form fields with the fetched data
                $("#footer-copyright").val(data.about_title);
                quillAdd.root.innerHTML = data.about_content;

                // Handle multiple images if available
                if (data.about_image) {
                    // Split the images string into an array of filenames
                    var images = data.about_image.split(',');
                    var imageHTML = '';

                    // Loop through each image and generate HTML
                    $(".email-repeater2").empty();
                    images.forEach(function(image) {
                        imageHTML += `
                    <div class="image-item mb-3" data-image="${image.trim()}">
                        <img src="uploads/${image.trim()}" alt="Page Image" style="width: 200px; height: 200px;" class="img-thumbnail">
                        <button type="button" class="btn btn-danger btn-sm delete-image" data-image="${image.trim()}">
                            Delete
                        </button>
                    </div>
                `;
                    });

                    // Append the generated image HTML to the target container
                    $(".email-repeater2").append(imageHTML);
                }
            },
            error: function() {
                Swal.fire("Error!", "Failed to fetch about section data.", "error");
            }
        });
    }


    $(document).ready(function() {
        $(".email-repeater2").empty();
        loadAllData();
        // Initialize Quill editor when the DOM is ready
        quillAdd = new Quill('#snow-editor-new', {
            theme: 'snow'
        });

        // Fetch and load existing data into the form



        // Handle 'Add More File' button click
        // Handle 'Add More File' button click
        $("button[data-repeater-create]").on("click", function() {
            // Create a new file input element
            var newFileInput = `
        <div class="email-repeater2 mb-3">
            <label class="form-label">Page Images</label>
            <input type="file" name="about_images[]" class="form-control mb-3" multiple>
            <button type="button" class="btn btn-danger btn-sm" data-repeater-delete>Delete</button>
        </div>
    `;

            // Append the new file input to the repeater list
            $("div[data-repeater-list='repeater-group']").append(newFileInput);
        });

        // Handle file input delete button click
        $(document).on("click", "button[data-repeater-delete]", function() {
            $(this).closest(".email-repeater2").remove();
        });


        // Handle file input delete button click
        $(document).on("click", "button[data-repeater-delete]", function() {
            $(this).closest(".row").remove();
        });
    });

    $("#AboutSectiondata").on("submit", function(e) {
        e.preventDefault();

        let editorContent = quillAdd.root.innerHTML;
        let formData = new FormData(this);
        formData.append('about_content', editorContent);


        $.ajax({
            url: "query.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                // console.log(response);

                // alert(response);
                if (response == 1) {
                    // $("#AboutSectiondata").trigger("reset");
                    $(".email-repeater2").empty();
                    loadAllData();
                    Swal.fire("Success!", "About section updated successfully.", "success");

                } else {
                    Swal.fire("Error!", "Failed to update about section.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            }
        });
    });

    $(document).on("click", ".delete-image", function() {
        var imageName = $(this).data("image");
        var imageItem = $(this).closest(".image-item");

        Swal.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the image.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        deleteImage: true,
                        imageName: imageName
                    },
                    success: function(response) {
                        // alert(response);
                        if (response == 1) {

                            $(".email-repeater2").empty();
                            loadAllData();
                            Swal.fire("Deleted!", "The image has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete the image.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred.", "error");
                    }
                });
            }
        });
    });
</script>
<!---------------------------------------------- contact page section ---------------------------------------->
<script>
    function loadContactAllData() {
        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                loadContactAllData: true
            },
            success: function(response) {

                $('#loadContactAllData').html(response);

            },
            error: function() {
                Swal.fire("Error!", "Failed to fetch about section data.", "error");
            }
        });
    }
    loadContactAllData();
    $(document).on("click", ".ContacDeleteById", function() {
        var id = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the image.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        ContacDeleteById: id
                    },
                    success: function(response) {
                        // alert(response);
                        if (response == 1) {
                            loadContactAllData();
                            Swal.fire("Deleted!", "Data has been deleted.", "success");
                        } else {
                            Swal.fire("Error!", "Failed to delete.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred.", "error");
                    }
                });
            }
        });
    });
</script>