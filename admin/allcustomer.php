<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");
?>
<style>
    .table-danger {
        background-color: #f8d7da !important;
        color: blue !important;
    }
</style>

<div class="body-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="datatables">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <h4 class="card-title mb-0">All Customers</h4>
                            </div>
                            <div class="table-responsive" style="max-height: 400px; overflow-x: auto; overflow-y: auto;">
                                <table id="data_show" class="table table-striped table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip code</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadCustomerData">

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


<?php include("inc/footer.php"); ?>

<script>
    $(document).ready(function() {
        $('#data_show').DataTable({

            responsive: true,
            lengthMenu: [10, 25, 50, 100], // Options for the number of rows to show
            pageLength: 10 // Default number of rows displayed
        });
    });
</script>

<script>
    function loadCustomerData() {
        // alert("load function work");
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                loadCustomerData: 1
            },
            success: function(data) {
                // alert(data);
                $('#loadCustomerData').html(data);
            }
        });
    }
    loadCustomerData();

    $(document).on('change', '.form-check-input', function() {
        let categoryId = $(this).data('id');
        let newStatus = $(this).is(':checked') ? 1 : 0;
        let row = $(this).closest('tr'); // Get the closest row for the customer

        // Update the row color based on the status immediately
        if (newStatus == 1) {
            row.removeClass('table-danger'); // Remove red background for active status
        } else {
            row.addClass('table-danger'); // Add red background for inactive status
        }

        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                updateCustomerStatus: true,
                id: categoryId,
                status: newStatus
            },
            success: function(response) {
                if (response.trim() === "1") {
                    Swal.fire("Success!", "Customer status updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to update Customer status.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred while updating status.", "error");
            },
        });
    });
</script>