<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");
 

?>




<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <!-- -------------------------------------------- -->
                <!-- Welcome Card -->
                <!-- -------------------------------------------- -->



            </div>
        </div>
    </div>
</div>

<?php

include("inc/footer.php");

?>