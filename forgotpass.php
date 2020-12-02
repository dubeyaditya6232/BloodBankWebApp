<?php
session_start();

include('connect.php');
$true=1;
if (isset($_POST['sendOTP_btn'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $sql = "SELECT * FROM users WHERE  username='$username'";
    $result = mysqli_query($db, $sql);
    $_SESSION['user']=$username;
    $temp = $result->fetch_assoc();
    $email = $temp['Email'];
    $_SESSION['email']=$email;
    if ($result) {

      if (mysqli_num_rows($result) > 0) {
        $otp = rand(111111, 999999);
        echo '<script>alert("OTP sent to registered Email address");</script>';
        //echo '<script>window.stop()</script>';
        $msg = "An OTP has been sent to your entered email";
        $mailHtml = "Your OTP Verification number is " . $otp;
        mysqli_query($db, "INSERT INTO forgot_pass(email, otp, username) VALUES('$email','$otp','$username')");
          
        smtp_mailer($email,'Forgot password OTP',$mailHtml);
        echo '<script>window.location.href = "enter-otp.php";</script>';
        ?>
    <!--<script>
            jQuery('.second_box').show();
            jQuery('.first_box').hide();
    </script>-->
  <?php
      } else {
        $_SESSION['message'] = "Incorrect Username";
      }
    }
  }

/*if (isset($_POST['checkOTP_btn'])) {
  $entered_otp = mysqli_real_escape_string($db, $_POST['otp']);
  $_SESSION['enteredOTP']=$entered_otp;
  echo '<script>window.location.href = "enter-otp.php";</script>';
  $username = $_SESSION['user'];
  $email = $_SESSION['email'];
  $res = mysqli_query($db, "SELECT * from forgot_pass where email = '$email' and otp = '$entered_otp'");
  if ($res->num_rows >0) {
    mysqli_query($db, "DELETE FROM forgot_pass where email = '$email'");?>
    <!--<script>
            jQuery('.third_box').show();
            jQuery('.second_box').hide();
    </script>-->
  <?php
  } else {
    echo '<script>alert("Invalid OTP");</script>';
    }
}*/

/*if (isset($_POST['continue_btn'])) {
  $pwd = mysqli_real_escape_string($db, $_POST['new_pass']);
  $cpwd = mysqli_real_escape_string($db, $_POST['confirm_pass']);
  $_SESSION['pwd']=$pwd;
  $_SESSION['cpwd']=$cpwd;
  $email = $_SESSION['email'];
  if($pwd == $cpwd){
      $pwd=md5($pwd);
      mysqli_query($db, "UPDATE users SET password = '$pwd' where Email = '$email'");
      echo '<script>alert("Password Reset Successfully");
      window.location.href = "login.php";
      </script>';
  } else {
    echo '<script>alert("two Passwords do not  match");</script>';
    }
}*/

function smtp_mailer($to, $subject, $msg)
  {
    require_once("smtp/class.phpmailer.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'TLS';
    $mail->Host = "smtp.sendgrid.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "";
    $mail->Password = "";
    $mail->SetFrom("fakeforapps0001@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    if (!$mail->Send()) {
      return 0;
    } else {
      return 1;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {

      background-color: #cceabb;
    }

    /*.background{
  background-image: url('img/abg3.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  width:100%;
  height:auto;
}*/
    .nav-tabs>li {
      float: none;
      display: inline-block;
      zoom: 1;
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
    /*.second_box{display: none;}
    .third_box{display: none;}*/
  </style>
</head>

<body class=background>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!--<P class="navbar-brand">Menu</P>-->
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
      </div>

      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  <div id="logo1">
    <center><img class="img-responsive" src="img/logo.jpg" alt="RAKTIM"></center>
  </div>
  <br>
  <main class="main-content">
    <?php
    if (isset($_SESSION['message'])) {
      echo "<div class='text-center bg-danger'>" . $_SESSION['message'] . "</div>";
      unset($_SESSION['message']);
    }
    ?>
    <center>
        <div class="tab-content">
        <div id="UserLogin" class="container tab-pane  active " role="tabpanel" aria-labelledby="ForgotPass-tab">
          <form method="post">
            <h2> Forgot Password </h2>
            <hr style="border: 1px solid black;">
            <div class="form-group first_box">
              <span>
                <font color="red"><b> Enter Username : </b></font>
              </span><br>
            </div>
            <div class="form-group">
              <input type="text" name="username" class="textInput form-control" required>
              <br>
            <button name="sendOTP_btn" class="btn btn-success">Continue</button>
            </div>
          </form>
          <!--<form method="POST">
            <div class="form-group second_box">
              <span>
                <font color="red"><b> Enter OTP : </b></font>
              </span><br>
              <input type="text" name="otp" class="textInput form-control" required>
              <br>
              <button  name="checkOTP_btn" class="btn btn-success">Continue</button>
            </div>
          </form>-->
          <!--<form method="POST">
            <div class="form-group third_box">
              <span>
                <font color="red"><b> Enter New Password : </b></font>
              </span>
              <input type="password" name="new_pass" class="textInput form-control"  required>
              <br>
              <span>
                <font color="red"><b> Enter New Password : </b></font>
              </span>
              <input type="password" name="confirm_pass" class="textInput form-control" required>
            <br>
            <button name="continue_btn" class="btn btn-success">Continue to Login</button>
            </div>
          </form>-->
            </div>
        </div>
    </center>
      
  </main>
</body>

</html>