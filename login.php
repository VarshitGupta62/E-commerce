<?php

include("inc/header.php");

?>

<style>
  .contler-log {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #f8f8f8;
    padding-top: 150px;
  }

  .gaurav-log {
    width: 90%;

    max-width: 400px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
  }

  .form-box {
    padding: 20px;
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.5rem;
  }

  .input-box {
    position: relative;
    margin-bottom: 20px;
  }

  .input-box input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
  }

  .input-box label {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    background: #fff;
    padding: 0 5px;
    font-size: 0.9rem;
    color: #aaa;
    transition: 0.3s ease;
  }

  .input-box input:focus+label,
  .input-box input:not(:placeholder-shown)+label {
    top: -8px;
    font-size: 0.75rem;
    color: #333;
  }

  .btn {
    display: block;
    width: 100%;
    padding: 10px;
    background: #ff5722;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: 0.3s ease;
  }

  .btn:hover {
    background: #e64a19;
  }

  .switch {
    text-align: center;
    margin-top: 15px;
  }

  .switch a {
    color: #ff5722;
    text-decoration: none;
    font-weight: bold;
  }

  .switch a:hover {
    text-decoration: underline;
  }

  .hidden {
    display: none;
  }
</style>

<div class="contler-log">
  <div class="gaurav-log">
    <div class="form-box">
      <div class="form login-form">
        <h2>Login</h2>
        <form id="userlogin">
          <div class="input-box">
            <input name="userloginEmail" type="email" required>
            <label>Email ID / Mobile No</label>
          </div>
          <div class="input-box">
            <input name="userloginPassword" type="password" required>
            <label>Password</label>
          </div>
          <button type="submit" class="btn">Log In</button>
          <?php
          // session_start();
          // var_dump($_SESSION['user_id']);
          ?>
          <p class="switch">New to our website? <a href="#" id="registerLink">Register Here</a></p>
        </form>
      </div>
      <div style="margin-top: 100px;" class="form register-form hidden"  >
        <h2>Register</h2>
        <form  id="loginForm">
          <div class="input-box">
            <input type="text" name="login_name" required>
            <label>Full Name</label>
          </div>
          <div class="input-box">
            <input
              type="number"
              id="mobileInput"
              name="login_mobile"
              maxlength="10"
              required
              placeholder="Enter your 10-digit mobile number">
            <label>Mobile No.</label>
          </div>
          <div class="input-box">
            <input type="email" name="login_gmail" required>
            <label>Gmail</label>
          </div>
          <div class="input-box">
            <input type="password" name="login_password" required>
            <label>Password</label>
          </div>
          <button type="submit" class="btn">Continue</button>
          <p class="switch">Already have an account? <a href="#" id="loginLink">Sign In</a></p>
        </form>
      </div>
      <div class="form otp-form hidden">
        <h2>Verify OTP</h2>
        <form id="otpForm">
          <div class="input-box">
            <input type="number" name="otp" required>
            <label>OTP</label>
          </div>
          <button type="submit" class="btn">Verify OTP</button>
          <div id="timer" class="timer"></div>
          <br>
          <button type="button" id="resendOtpBtn" class="btn">Resend OTP</button>
        </form>
      </div>


    </div>
  </div>
</div>






<!-- Footer Start -->

<!-- Footer End -->

<!-- Copyright Start -->

<!-- Copyright End -->



<!-- Back to Top -->
<!-- <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>    -->


<script>
  document.getElementById("registerLink").addEventListener("click", function(e) {
    e.preventDefault();
    document.querySelector(".login-form").classList.add("hidden");
    document.querySelector(".register-form").classList.remove("hidden");
  });

  document.getElementById("loginLink").addEventListener("click", function(e) {
    e.preventDefault();
    document.querySelector(".register-form").classList.add("hidden");
    document.querySelector(".login-form").classList.remove("hidden");
  });
</script>




<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Template Javascript -->
<script src="./js/addtocart.js"></script>
<script src="js/main.js"></script>


<script>
  AOS.init({
    Duration: 1000,
    offset: 200,
    delay: 100,
  })
</script>

<script>
  $('#loginForm').on('submit', function(e) {
    e.preventDefault();

    // Disable the submit button to prevent multiple clicks
    const submitButton = $(this).find('button[type="submit"]');
    submitButton.prop('disabled', true);

    let formData = new FormData(this);

    // Validate form data (basic client-side validation)
    let isValid = true;
    let mobileNumber = $('#mobileInput').val().trim();

    $('#loginForm input').each(function() {
      if ($(this).val().trim() === '') {
        isValid = false;
        Swal.fire("Please fill all the fields", "", "warning");
        submitButton.prop('disabled', false); // Re-enable the button on validation failure
        return false; // Exit the loop on the first empty field
      }
    });

    // Validate Mobile Number
    if (isValid && !/^\d{10}$/.test(mobileNumber)) { // Check if the number is exactly 10 digits
      isValid = false;
      Swal.fire("Invalid Mobile Number", "Please enter a valid 10-digit mobile number.", "warning");
      submitButton.prop('disabled', false); // Re-enable the button on validation failure
      return;
    }

    if (!isValid) return; // Exit if validation fails

    $.ajax({
      url: 'admin/userlogin.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // alert(response);
        let res = JSON.parse(response);

        if (res.status === 1) {
          Swal.fire("Success", "Please enter the OTP sent to your email.", "success");

          // Hide the login form and show the OTP form
          $('.register-form').addClass('hidden');
          $('.otp-form').removeClass('hidden');
          timerDuration = 300; // Reset to 5 minutes
          startTimer();

        } else {
          Swal.fire("Error", res.message, "error");
          submitButton.prop('disabled', false); // Re-enable the button on error
        }
      },
      error: function() {
        Swal.fire("Something went wrong.", "", "error");
        submitButton.prop('disabled', false); // Re-enable the button on error
      }
    });
  });


  $('#userlogin').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
      url: 'admin/userlogin.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // alert(response);
        try {
          let res = JSON.parse(response);
          if (res.status === 1) {
            Swal.fire("Success", res.message, "success").then(() => {
              window.location.href = "dashboard.php";
            });
          } else {
            Swal.fire("Error", res.message, "error");
          }
        } catch (error) {
          Swal.fire("Error", "Invalid server response.", "error");
        }
      },
      error: function() {
        Swal.fire("Something went wrong.", "", "error");
      }
    });
  });



  $('#otpForm').on('submit', function(e) {
    e.preventDefault();
    // alert("otp button clicked");
    let otp = $('input[name="otp"]').val();
    const submitButton = $(this).find('button[type="submit"]');
    submitButton.prop('disabled', true);


    $.ajax({
      url: 'admin/userlogin.php',
      type: 'POST',
      data: {
        otp: otp
      },
      success: function(response) {
        // alert(response);
        let res = JSON.parse(response);


        if (res.status == 1) {
          Swal.fire({
            title: "Success!",
            text: res.message,
            icon: "success",
            showCancelButton: false,
            confirmButtonText: "Continue",
            preConfirm: () => {
              // After the user clicks the "Continue" button
              window.location.href = "login.php"; // Redirect to the login page
            }
          });
        } else {
          Swal.fire("Error", res.message, "error");
          submitButton.prop('disabled', false); // Re-enable the button on error
        }
      },
      error: function(err) {
        Swal.fire("Something went wrong.", "", "error");
        submitButton.prop('disabled', false); // Re-enable the button on error
      }
    });
  });

  document.getElementById("resendOtpBtn").addEventListener("click", function(e) {
    e.preventDefault();

    const resendbutton = $(this); // This is the correct way to select the button using jQuery
    resendbutton.prop('disabled', true); // Disable the button to prevent multiple clicks

    $.ajax({
      url: 'admin/userlogin.php',
      type: 'POST',
      data: {
        resend_otp: true
      },
      success: function(response) {
        let res = JSON.parse(response); // Parse the JSON response

        if (res.status === 1) {
          Swal.fire("Success", res.message, "success");

          timerDuration = 300; // Reset to 5 minutes
          startTimer();

        } else {
          Swal.fire("Error", res.message, "error");
          resendbutton.prop('disabled', false); // Re-enable the button if there is an error
        }
      },
      error: function() {
        Swal.fire("Something went wrong.", "", "error");
        resendbutton.prop('disabled', false); // Re-enable the button if there's an error in the request
      }
    });
  });



  let timerDuration = 300; // 5 minutes in seconds
  const resendOtpBtn = document.getElementById('resendOtpBtn');
  const timerDisplay = document.getElementById('timer');

  function startTimer() {
    resendOtpBtn.disabled = true; // Disable the button when the timer starts
    resendOtpBtn.textContent = "Resend OTP";

    // Initial message display
    timerDisplay.innerHTML = `Your OTP will expire in <span id="countdown"></span>`;
    const countdownSpan = document.getElementById('countdown');

    const interval = setInterval(function() {
      // Calculate minutes and seconds
      const minutes = Math.floor(timerDuration / 60);
      const seconds = timerDuration % 60;

      // Format the time as MM:SS
      countdownSpan.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

      // Decrease the timer by 1 second
      timerDuration--;

      // When timer expires
      if (timerDuration < 0) {
        clearInterval(interval);
        timerDisplay.textContent = "Your OTP has expired."; // Update to expiration message
        resendOtpBtn.disabled = false; // Enable the "Resend OTP" button
        resendOtpBtn.textContent = "Resend OTP"; // Change button text
      }
    }, 1000); // Update every 1000ms (1 second)
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>