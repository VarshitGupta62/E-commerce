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
                        <h4 class="mb-4 mb-sm-0 card-title"> Add Shipping Cost</h4>
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
                                <h4 class="card-title mb-0">All Shipping Cost</h4>
                            </div>
                            <div class="table-responsive">
                                <table id="" class="table w-100 table-striped table-bordered display text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>City</th>
                                            <th>Shipping Cost</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadshippingcostData">

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
                    Add Shipping Cost
                </h4>
                <button type="button" class="btn-close addmodelclose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="shippingcostDataSubmit">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="">City</label>
                        <!-- <input type="number" name="category_id" class="form-control" id="recipient-name1"> -->
                        <select name="city_id" class="select2 form-control">

                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="">Shipping Cost</label>
                        <input type="number" name="shippingcost" class="form-control" id="recipient-name1">
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
    function loadCity() {
        $.ajax({
            url: "query.php", // Path to the PHP script
            type: 'POST',
            data: {
                loadCity: 1
            },
            success: function (data) {
                // alert(data);
                $("select[name='city_id']").html("<option value=''> Select</option>" + data);
            },
            error: function () {
                Swal.fire("Error!", "Failed to load City.", "error");
            },
        });
    }
    loadCity();
    let loadshippingcostData = function() {
        $.ajax({
            url: 'query.php',
            type: 'POST',
            data: {
                loadshippingcostData: 1
            },
            success: function(data) {
                $('#loadshippingcostData').html(data);
            }
        })
    }
    loadshippingcostData();
    $('#shippingcostDataSubmit').on('submit', function(e) {
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
                    $('#shippingcostDataSubmit').trigger('reset');
                    $('.addmodelclose').click();
                    Swal.fire(
                        "Shipping-Cost added successfully.",
                        "",
                        "success"
                    );

                    loadshippingcostData();
                } else {
                    alert("Failed to add Shipping-Cost.");
                }
            },
            error: function(err) {
                console.log(err);
                alert("There was an error Shipping-Cost.");
            }
        });
    });
    $(document).on('click', '.shippingcostDeleteById', function() {
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
                        deleteshippingcostById: id
                    },
                    success: function(data) {
                        if (data.trim() === "1") {
                            Swal.fire("Deleted!", "The shippingcost has been deleted.", "success");
                            loadshippingcostData(); // Reload shippingcost data
                        } else {
                            Swal.fire("Error!", "Failed to delete the shippingcost.", "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "An error occurred while deleting the shippingcost.", "error");
                    },
                });
            }
        });
    });
</script>