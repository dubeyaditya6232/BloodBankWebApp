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
    $sql2 = "SELECT * FROM users WHERE  username='$username' and Email='$email'";
    $result2 = mysqli_query($db, $sql);
    if ($result2) {
      if (mysqli_num_rows($result2) > 0) {
        $otp = rand(111111, 999999);
        echo '<script>alert("OTP sent to registered Email address");</script>';
        //echo '<script>window.stop()</script>';
        $msg = "An OTP has been sent to your entered email";
        $mailHtml = "Your OTP Verification number is " . $otp;
        mysqli_query($db, "INSERT INTO forgot_pass(email, otp, username) VALUES('$email','$otp','$username')");
          
        smtp_mailer($email,'Forgot password OTP',$mailHtml);
        echo '<script>window.location.href = "enter-otp.php";</script>';
        ?>
  <?php
      } else {
        $_SESSION['message'] = "Incorrect Username";
      }
    }
  }

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
            </div>
        </div>
    </center>
      
  </main>
</body>

</html>