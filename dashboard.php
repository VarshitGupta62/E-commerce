<?php 

include("admin/config.php");
include("inc/header.php");

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM `customer` WHERE id = $user_id";

$result = mysqli_query($conn, $query);

if ($result) {
    $customer = mysqli_fetch_assoc($result);
} else {
    die("Error fetching customer data: " . mysqli_error($conn));
}

?>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<style>
    .nav-link {
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
                <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Hello <?php echo htmlspecialchars($customer['cust_name']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/000/439/863/original/vector-users-icon.jpg" alt="Profile" class="rounded-circle img-fluid mb-2" style="width: 100px;">
                    <h5>Welcome to your profile</h5>
                </div>
                <nav class="nav flex-column text-center mt-3">
                    <a href="dashboard.php" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
                    <a href="oderpage.php" class="nav-link"><i class="fas fa-shopping-cart"></i>Orders</a>
                    <a href="address.php" class="nav-link"><i class="fas fa-home"></i>Addresses</a>
                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </nav>
            </div>
        </div>

        <!-- Sidebar for Large Screens -->
        <div class="col-md-3 d-none d-md-block bg-light vh-100">
            <div class="text-center py-4">
                <img src="https://static.vecteezy.com/system/resources/previews/000/439/863/original/vector-users-icon.jpg" alt="Profile" class="rounded-circle img-fluid mb-2" style="width: 100px;">
                <h5>Hello <?php echo htmlspecialchars($customer['cust_name']); ?></h5>
                <p>Welcome to your profile</p>
            </div>
            <nav class="nav flex-column text-center">
                <a href="dashboard.php" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="oderpage.php" class="nav-link"><i class="fas fa-shopping-cart"></i>Orders</a>
                <a href="address.php" class="nav-link"><i class="fas fa-home"></i>Addresses</a>
                <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-sm-12">
            <div class="p-4">
                <h2>Dashboard</h2>
                <?php

                // echo($_SESSION['user_id']);
                ?>
                <p>Update Profile Details</p>
                <form id="dashboardDataSubmit">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="dashboardName" class="form-control" id="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($customer['cust_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="dashboardEmail" class="form-control" id="email" placeholder="annie@example.com" value="<?php echo htmlspecialchars($customer['cust_email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dashboardPhone" class="form-label">Phone</label>
                        <input type="tel" name="dashboardPhone" class="form-control" id="dashboardPhone" placeholder="1234 567890" pattern="[0-9]{10}" maxlength="10" value="<?php echo htmlspecialchars($customer['cust_phone']); ?>" required>
                        <small class="form-text text-muted">Enter a 10-digit phone number.</small>
                    </div>
                    <div class="mb-3">
                        <label for="dashboardAddress" class="form-label">Address</label>
                        <textarea class="form-control" name="dashboardAddress" id="dashboardAddress" rows="2" placeholder="Enter your full address" required><?php echo htmlspecialchars($customer['cust_address']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include("inc/footer.php"); ?>
<script>
    document.getElementById('dashboardPhone').addEventListener('input', function() {
        const phone = this.value;
        if (phone.length > 10) {
            this.value = phone.slice(0, 10); // Limit to 10 digits
        }
    });

    $('#dashboardDataSubmit').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: 'admin/query.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                alert(response);

                // if (response == 1) {

                //     Swal.fire(
                //         "Data updated successfully.",
                //         "",
                //         "success"
                //     );

                // } else {
                //     alert("Failed to Update data.");
                // }
            },
            error: function(err) {
                console.log(err);
                alert("Something went wrong.");
            }
        });
    });
</script>