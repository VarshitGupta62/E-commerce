<?php include("inc/header.php"); ?>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<style>
    .nav-link{
        text-align: start;
    }
    .sidebar .nav-link {
        color: #212529;
        /* Default text color */
        font-weight: 500;
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 5px;
    }

    .sidebar .nav-link:hover {
        background-color: #e9ecef;
        /* Light hover effect */
    }

    .nav .active {
        background-color: #81c408;
        /* Bootstrap primary blue */
        color: #ffffff;
        /* White text */
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        /* Spacing between icon and text */
        font-size: 1.2rem;
        /* Icon size */
    }

    /* Small devices (phones, less than 576px) */
    @media (max-width: 575.98px) {
        .dashboard {
            margin-top: 8rem;
        }
    }

    /* Medium devices (tablets, 576px to 767px) */
    @media (min-width: 576px) and (max-width: 767.98px) {
        .dashboard {
            margin-top: 8rem;
        }
    }

    /* Large devices (desktops, 768px to 991px) */
    @media (min-width: 768px) and (max-width: 1025px) {
        .dashboard {
            margin-top: 12rem;
        }
    }

    /* Extra large devices (1200px and up) */
    @media (min-width: 1200px) {
        .dashboard {
            margin-top: 13rem;
        }
    }
</style>

<div class="container-fluid dashboard">
    <div class="row">
        <!-- Offcanvas Sidebar Button -->
        <div class="d-md-none py-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                Menu
            </button>
        </div>

        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Hello Gaurav Tyagi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="text-center">
                    <img src="./Images/sofa-imgs/side-table3.webp" alt="Profile" class="rounded-circle img-fluid mb-2" style="width: 100px;">
                    <h5>Welcome to your profile</h5>
                </div>
                <nav class="nav flex-column text-center mt-3">
                    <a href="dashboard.php" class="nav-link "><i class="fas fa-th-large"></i> Dashboard</a>
                    <a href="oderpage.php" class="nav-link active"><i class="fas fa-shopping-cart"></i>Orders</a>
                    <a href="address.php" class="nav-link"><i class="fas fa-home"></i>Addresses</a>
                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </nav>
            </div>
        </div>

        <!-- Sidebar for Large Screens -->
        <div class="col-md-3 d-none d-md-block bg-light vh-100">
            <div class="text-center py-4">
                <img src="./Images/sofa-imgs/side-table3.webp" alt="Profile" class="rounded-circle img-fluid mb-2" style="width: 100px;">
                <h5>Hello Gaurav Tyagi</h5>
                <p>Welcome to your profile</p>
            </div>
            <nav class="nav flex-column text-center">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="oderpage.php" class="nav-link active"><i class="fas fa-shopping-cart"></i>Orders</a>
                <a href="address.php" class="nav-link"><i class="fas fa-home"></i>Addresses</a>
                <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-sm-12">
            <div class="container my-5">
                <h2 class="mb-4">Orders</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th class="table-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#6523</td>
                                <td>September 10, 2020</td>
                                <td>Processing</td>
                                <td>Rs.326.63 for 3 items</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#6523</td>
                                <td>September 10, 2020</td>
                                <td>On Hold</td>
                                <td>Rs.326.63 for 3 items</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#6523</td>
                                <td>September 10, 2020</td>
                                <td>Processing</td>
                                <td>Rs.326.63 for 3 items</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>#6523</td>
                                <td>September 10, 2020</td>
                                <td>Processing</td>
                                <td>Rs.326.63 for 3 items</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include("inc/footer.php"); ?>