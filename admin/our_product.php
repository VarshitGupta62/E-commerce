<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");


?>





<!-- -------------------------------------------- -->
<!-- Welcome Card -->
<!-- -------------------------------------------- -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title"> Active Our Product</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">
                                    <button type="button" class="btn btn-rounded btn-secondary" data-bs-toggle="modal" data-bs-target="#samedata-modal" data-bs-whatever="@mdo">
                                       Add
                                    </button>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- start Basic Area Chart -->
        <div class="row">
            <div class="col-lg-12 ">


                <div class="datatables">
                    <!-- start File export -->
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <h4 class="card-title mb-0">All Active Our Product</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="" class="table w-100 table-striped table-bordered display text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Subcategory Name</th>
                                            <th>Status</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadOurPorductData">

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <!-- end Basic Area Chart -->
    </div>
</div>


<!---------------------------------- model for add Product -------------------------------->


<div class="modal fade" id="samedata-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="exampleModalLabel1">
                    Active Our Product
                </h4>
                <button type="button" class="btn-close addmodelclose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="OurProductDataSubmit">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="">Select Subcategory</label>
                        <select name="our_product_id" id="subcategory-id" class="form-control select2">
                            <!-- Dynamic options -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger " data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-secondary">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





<?php

include("inc/footer.php");

?>

<script>

function loadSubcategories() {
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadSubcategories: 1
            },
            success: function(data) {
                $("#subcategory-id").html("<option value=''>Select Subcategory</option>" + data);
            },
            error: function() {
                Swal.fire("Error!", "Failed to load subcategories.", "error");
            }
        });
    }

    loadSubcategories();


    let loadOurPorductData = function() {
        $.ajax({
            url: 'query.php',
            type: 'POST',
            data: {
                loadOurPorductData: 1
            },
            success: function(data) {
                $('#loadOurPorductData').html(data);
            }
        })
    }
    loadOurPorductData();

    $('#OurProductDataSubmit').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: 'query.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                // alert(response);

                if (response == 1) {
                    // alert("Data added successfully.");
                    $('#OurProductDataSubmit').trigger('reset');
                    $('.addmodelclose').click();
                    Swal.fire(
                        "Product active successfully.",
                        "",
                        "success"
                    );

                    loadOurPorductData();
                } else {
                    alert("Failed to add data.");
                }
            },
            error: function(err) {
                console.log(err);
                alert("There was an error uploading the file.");
            }
        });
    });
    $(document).on('change', '.form-check-input', function() {
        let productId = $(this).data('id');
        let newStatus = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                updateOurProductStatus: true,
                id: productId,
                status: newStatus
            },
            success: function(response) {
                // alert(response);
                if (response.trim() === "1") {
                    Swal.fire("Success!", "Our product status updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update Our product status.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred while updating status.", "error");
            },
        });
    });
    $(document).on('click', '.Our_productDeleteById', function() {
        let id = $(this).data('id'); // Get the ID from data attribute
        if (!id) {
            alert("Invalid ID.");
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "query.php",
                    type: "POST",
                    data: {
                        deleteOur_productById: id
                    },
                    success: function(data) {
                        if (data.trim() === "1") {
                            Swal.fire("Deleted!", "The Our product has been deleted.", "success");
                            loadOurPorductData(); // Reload Our_product data
                        } else {
                            Swal.fire("Error!", "Failed to delete the Our product.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred while deleting the Our product.", "error");
                    },
                });
            }
        });
    });
</script>