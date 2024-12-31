<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");

$result = $conn->query("SELECT * FROM social_links WHERE id = 1");
$row = $result->fetch_assoc();
?>

<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Tab Navigation -->


        <!-- Tab Content -->
        <div class="tab-content mt-3" id="productTabContent">
            <!-- Logo Tab -->
            <div class="tab-pane fade show active" id="Home" role="tabpanel" aria-labelledby="Home-tab">
                <div class="card card-body py-3">
                    <h4 class="card-title mb-6" style="text-align: center;">Update your link</h4>
                    <form id="linkdatasubmit">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Twitter Link</label>
                                <input type="text" name="twitter_link" class="form-control" value="<?php echo $row['twitter_link']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Facebook Link</label>
                                <input type="text" name="facebook_link" class="form-control" value="<?php echo $row['facebook_link']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">Youtube Link</label>
                                <input type="text" name="youtube_link" class="form-control" value="<?php echo $row['youtube_link']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="about-title" class="form-label">LinkedIn Link</label>
                                <input type="text" name="linkedin_link" class="form-control" value="<?php echo $row['linkedin_link']; ?>">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Add</button>
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
    $(document).ready(function() {
        $('#data_show').DataTable({

            responsive: true,
            lengthMenu: [10, 25, 50, 100], // Options for the number of rows to show
            pageLength: 10 // Default number of rows displayed
        });
    });
</script>
<script>
    // Add Testimonial
    $("#linkdatasubmit").on("submit", function(e) {
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
                    Swal.fire("Success!", "Link updated successfully.", "success");
                } else {
                    Swal.fire("Error!", "Failed to updated link.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred.", "error");
            },
        });
    });
</script>