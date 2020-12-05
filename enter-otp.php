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
if (isset($_POST['back_btn'])) {
    echo '<script>window.location.href = "forgotpass.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    body {

      background-color: #cceabb;
    }
      
    .nav-tabs {
      text-align: center;
    }

    #logo1 img {
      width: 25%;

    }

    table {
      border-collapse: collapse;
    }

    th,
    td {
      padding: 0.5rem;
    }

    #UserLogin {
      width: 35rem;
      padding: 1rem;;
    }
      
    .tab { 
      display: inline-block; 
      margin-left: 40px;
    }
      
    @media only screen and (max-width: 600px) {
      h2 {
        font-size: 2rem;
      }

      #logo1 img {
        width: 50%;
      }

      #UserLogin {
        width: fit-content;
      }
    }
  </style>
</head>
<body class=background>
  <div id="logo1">
    <center><img class="img-responsive" src="img/logo.jpg" alt="RAKTIM"></center>
  </div>
  <br>
  <main class="main-content">
    <center>
        <div class="tab-content">
        <div id="UserLogin" class="container tab-pane  active " role="tabpanel" aria-labelledby="EnterOTP-tab">
            <form method="POST">
                <h2> Verify Your OTP </h2>
                <hr style="border: 1px solid black;">
                <div class="form-group">
                <span>
                <font color="red"><b> *Your registered email address is <?php echo $_SESSION['email'] ?> </b></font>
                </span>
                <br><br>    
                <span>
                <font color="red"><b> Enter OTP : </b></font>
                </span><br><br>
                <input type="text" name="otp" class="textInput form-control" style="width:150px;">
                <br><br>
                    <button name="back_btn" class="btn btn-success" style="width:90px;">Back</button>
                    <span class="tab"></span>
                    <button  name="checkOTP_btn" class="btn btn-success">Continue</button>
                </div>
            </form>
        </div>
        </div>
    </center>  
  </main>
</body>
</html>