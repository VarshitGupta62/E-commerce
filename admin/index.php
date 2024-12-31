
<?php

include("config.php");

$query = "SELECT * FROM settings WHERE id = 1"; // Assuming the data for footer is in the row with id 1
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $logo = $row['logo'];
    $favicon = $row['favicon'];
  
}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="uploads/<?= $favicon ?>">

    <!-- Core Css -->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Dakshayni Hand Craft</title>
    <style>
        .card {
            border: 1px solid #ddd;
            /* Light border around the card */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            background-color: #fff;
            /* White background */
            padding: 16px;
            /* Padding inside the card */
            margin-bottom: 16px;
            /* Space below the card */
        }
    </style>
</head>

<body style="background-color: #F9F8F2;">
    <!-- Preloader -->
    <div class="preloader">
        <img src="assets/images/logos/favicon.png" alt="loader" class="lds-ripple img-fluid">
    </div>
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden auth-bg min-vh-100 w-100 d-flex align-items-center justify-content-center">

            <!-- ------------------------------------------------- -->
            <!-- Part 1 -->
            <!-- ------------------------------------------------- -->
            <div class="card">

                <div class="col-xl-12">
                    <div class="row justify-content-center py-4">
                        <div class="position-relative text-center my-4">
                            <h3>Admin</h3>
                        </div>
                        <form id="loginform" >
                            <div class="mb-3">
                                <label for="text-name" class="form-label">Username</label>
                                <input type="text" name="adminUsername" class="form-control" id="text-name" placeholder="Enter your username" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <!-- <a class="text-primary link-dark fs-2" href="authentication-forgot-password2.html">Forgot Password?</a> -->
                                </div>
                                <input type="password" name="adminPassword" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-8 mb-4 rounded-1" >Login</button>
                        </form>
                    </div>
                </div>

            </div>


            <!-- ------------------------------------------------- -->
            <!-- Part 2 -->
            <!-- ------------------------------------------------- -->

        </div>


    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <!-- Import Js Files -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="assets/js/theme/app.init.js"></script>
    <script src="assets/js/theme/theme.js"></script>
    <script src="assets/js/theme/app.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- solar icons -->
    <script src="npm/iconify-icon%401.0.8/dist/iconify-icon.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginform').on("submit", function(e) {
                e.preventDefault();
                // alert("button click");
                let adminlogin = new FormData(this);

                $.ajax({
                    url: 'query.php',
                    type: "POST",
                    data: adminlogin,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // alert(data);
                        if (data == 1) {
                            window.location.href = "dashboard.php"; // Corrected typo
                        } else {
                            alert(data); // Show backend error message (Invalid username/password)
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An error occurred: " + xhr.responseText); // Handle server error
                    }
                });
            });
        });
    </script>
</body>

</html>