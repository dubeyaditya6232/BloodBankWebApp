<?php
session_start();

include('connect.php');
if (isset($_POST['checkOTP_btn'])) {
    $entered_otp = mysqli_real_escape_string($db, $_POST['otp']);
    $_SESSION['enteredOTP']=$entered_otp;
    //echo '<script>window.location.href = "enter-otp.php";</script>';
    $username = $_SESSION['user'];
    $email = $_SESSION['email'];
    $res = mysqli_query($db, "SELECT * from forgot_pass where email = '$email' and otp = '$entered_otp'");
    if ($res->num_rows >0) {
      mysqli_query($db, "DELETE FROM forgot_pass where email = '$email'");
      echo '<script>window.location.href = "new-password.php";</script>';
      ?>
      <!--<script>
              jQuery('.third_box').show();
              jQuery('.second_box').hide();
      </script>-->
    <?php
    } else {
      echo '<script>alert("Invalid OTP");</script>';
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
</head>
<body>
<form method="POST">
            <div class="form-group second_box">
              <span>
                <font color="red"><b> Enter OTP : </b></font>
              </span><br>
              <input type="text" name="otp" class="textInput form-control" required>
              <br>
              <button  name="checkOTP_btn" class="btn btn-success">Continue</button>
            </div>
          </form>
</body>
</html>