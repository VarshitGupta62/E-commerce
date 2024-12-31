<?php
session_start();
if (!isset($_SESSION['adminUsername'])) {
    header("Location: index.php");
}
include("inc/header.php");

include("config.php");

$query = "
    SELECT 
        (SELECT COUNT(*) FROM addproduct) as total_products,
        (SELECT COUNT(*) FROM `order`) as total_orders,
        (SELECT COUNT(*) FROM shippingcost) as total_shipping_cost,
        (SELECT COUNT(*) FROM `customer`) as total_customer
";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Get the counts
$total_products = $row['total_products'];
$total_orders = $row['total_orders'];
$total_shipping_cost = $row['total_shipping_cost'];
$total_customer = $row['total_customer'];
?>




?>




<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- -------------------------------------------- -->
                <!-- Welcome Card -->
                <!-- -------------------------------------------- -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-4 pb-0" data-simplebar="">
                            <div class="row flex-nowrap">
                                <div class="col">
                                    <div class="card primary-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:cart-outline" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> <?php echo $total_products; ?> </h4>
                                            <h6 class="fw-normal fs-3 mb-1">Total Product</h6>
                                            <a href="productmanagement.php" class="btn btn-white fs-2 fw-semibold text-nowrap">View Details</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card warning-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:account-group-outline" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"><?php echo $total_customer ?></h4>
                                            <h6 class="fw-normal fs-3 mb-1">Total Customer</h6>
                                            <a href="allcustomer.php" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card secondary-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:clipboard-check-outline" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> <?php echo $total_orders; ?></h4>
                                            <h6 class="fw-normal fs-3 mb-1">Total Order</h6>
                                            <a href="ordermanagement.php" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card success-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:clock-outline" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> 148</h4>
                                            <h6 class="fw-normal fs-3 mb-1">Pending Orders</h6>
                                            <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row flex-nowrap">
                                <div class="col">
                                    <div class="card  secondary-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:truck-check" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> 148</h4>
                                            <h6 class="fw-normal fs-3 mb-1">Pending Shippings</h6>
                                            <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card danger-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:package-variant" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">  <?php echo $total_shipping_cost; ?></h4>
                                            <h6 class="fw-normal fs-3 mb-1">Available Shippings</h6>
                                            <a href="shippingcost.php" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card warning-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="solar:recive-twice-square-linear" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> 148</h4>
                                            <h6 class="fw-normal fs-3 mb-1">Completed Shipping</h6>
                                            <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card primary-gradient">
                                        <div class="card-body text-center px-9 pb-4">
                                            <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                                <iconify-icon icon="mdi:checkbox-marked-circle-outline" class="fs-7 text-white"></iconify-icon>
                                            </div>
                                            <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"> 148</h4>
                                            <h6 class="fw-normal fs-3 mb-1">Completed Orders</h6>
                                            <a href="javascript:void(0)" class="btn btn-white fs-2 fw-semibold text-nowrap">View
                                                Details</a>
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
</div>

<?php

include("inc/footer.php");

?>