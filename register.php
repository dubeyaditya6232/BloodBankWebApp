<?php
session_start();
include('connect.php');
error_reporting(0);
if (isset($_SESSION['username'])) {
  echo '<script type="text/javascript">alert("You  are already Logged IN");
 window.location.href = "login.php";
</script>';
}
$msg = '';
$regmsg = '';

if (isset($_POST['register_btn'])) {
  $name = $_POST['name'];
  $city = $_POST['city'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $bloodgrp = $_POST['bgroup'];
  $username = $_POST['username'];
  $mno = $_POST['mno'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

  $_SESSION['email'] = $email;
  $_SESSION['name'] = $name;
  $_SESSION['city'] = $city;
  $_SESSION['gender'] = $gender;
  $_SESSION['age'] = $age;
  $_SESSION['bgrp'] = $bloodgrp;
  $_SESSION['uname'] = $username;
  $_SESSION['mno'] = $mno;
  $_SESSION['password'] = $password;

  $mobilequery = "SELECT * from users WHERE mobile = '$mno'";
  $mobileresult = $db->query($mobilequery);

  $emailquery = "SELECT * from users WHERE Email = '$email'";
  $emailresult = $db->query($emailquery);

  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($db, $query);

  /*---------------- email ID already exists ----------------------*/

  if ($emailresult->num_rows > 0) {
    $msg = "An Account already exist with the Email Address";
  }
  /*---------------------------------------------------------------- */
  /*------------------mobile number already exists-------------------*/ else if ($mobileresult->num_rows > 0) {
    $msg = "An Account already exist with the Mobile Number";
  }
  /*------------------------------------------------------------------ */

  /*-------------------- if username already exists -------------------*/ else if (mysqli_num_rows($result) > 0) {
    $msg = "An Account already exist with the Username";
  }
  /*------------------------------------------------------------------ */ else if ($password != $password2) {
    $_SESSION['message'] = "The two Password do not match";
  } else {
    $otp = rand(111111, 999999);
    echo '<script>show();</script>';
    $msg = "An OTP has been sent to your entered email";
    $mailHtml = "Your OTP Verification number is " . $otp;
    mysqli_query($db, "INSERT INTO otp_store(email, otp, username) VALUES('$email','$otp','$username')");

    smtp_mailer($email, 'Account Verification', $mailHtml);
  }
}
if (isset($_POST['otp_btn'])) {
  /*echo "Register button working properly";*/
  $entered_otp = $_POST['otp'];
  $email = $_SESSION['email'];
  $name = $_SESSION['name'];
  $city = $_SESSION['city'];
  $gender = $_SESSION['gender'];
  $age = $_SESSION['age'];
  $bloodgrp = $_SESSION['bgrp'];
  $username = $_SESSION['uname'];
  $mno = $_SESSION['mno'];
  $password = $_SESSION['password'];
  $res = mysqli_query($db, "SELECT * from otp_store where email = '$email' and otp = '$entered_otp'");
  $count = mysqli_num_rows($res);
  if ($count > 0) {
    mysqli_query($db, "DELETE FROM otp_store where email = '$email'");
    $password = md5($password); //hash password before storing for security purposes
    $sql = "INSERT INTO users(name, city, gender, age, bgroup, username, password , mobile ,Email  ) 
                           VALUES('$name','$city','$gender','$age','$bloodgrp','$username','$password','$mno','$email')";
    if ($db->query($sql) == true) {
      $regmsg = "Registration successfull";
    } else {
      $regmsg = "error" . $db->error;
    }
    unset($_SESSION['uname']);
    unset($_SESSION['email']);
    unset($_SESSION['city']);
    unset($_SESSION['gender']);
    unset($_SESSION['age']);
    unset($_SESSION['bgrp']);
    unset($_SESSION['mno']);
    unset($_SESSION['password']);
    unset($_SESSION['name']);
  } else {
    echo '<script>alert("Invalid OTP");</script>';
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
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    #error_msg {
      width: 50%;
      margin: 5px auto;
      height: 30px;
      border: 1px solid #FF0000;
      background: red;
      color: #FF0000;
      text-align: center;
      padding-top: 10px;
    }

    table {
      border-collapse: collapse;
    }

    th,
    td {
      padding: 0.5rem;
    }

    body {
      background-color: #e6ffff;
    }

    .nav-tabs>li {
      float: none;
      display: inline-block;
      zoom: 1;
    }

    .nav-tabs {
      text-align: center;
    }

    /*#hide{
      display:none;
    }*/
    .message {
      color: red;
    }

    @media only screen and (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }

      img {
        min-height: 5rem;
      }
    }
  </style>
</head>

<body>

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
  <div class="container" style="padding:0;">
    <img class="img-responsive" src="img\reg.jpg" alt="REGISTRATION FORM">
  </div>


  <main class="main-content">
    <br>
    <p class="text-center">Registering for this site is easy. Just fill the fields below,and well get a new account set up for free and in no time.</p>
    <br>
    <div>
      <center>
        <p>All fields are mandatory</p>
        <form method="post">
          <table>
            <tr>
              <td>Name : </td>
              <td><input type="text" name="name" class="textInput" placeholder="Enter Your Name" required></td>
            </tr>
            <tr>
              <td>City : </td>
              <td><input type="text" name="city" class="textInput" placeholder="Enter City" required></td>
            </tr>
            <tr>
              <td>Gender : </td>
              <td><input type="text" name="gender" class="textInput" placeholder="Enter Your Gender" required></td>
            </tr>
            <tr>
              <td>Age : </td>
              <td><input type="text" name="age" class="textInput" placeholder="Enter Your Age" required></td>
            </tr>
            <tr>
              <td><label for="bloodgroup">Blood Group: </label></td>
              <td><select name="bgroup" required>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                </select></td>
            </tr>
            <tr>
              <td>Username : </td>
              <td><input type="text" name="username" class="textInput" placeholder="Enter Your Username" required></td>
            </tr>
            <tr>
              <td>mobile No. : </td>
              <td><input type="text" name="mno" class="textInput" placeholder="Enter Your Mobile No." required></td>
            </tr>
            <tr>
              <td>Email : </td>
              <td><input type="email" id="email" name="email" class="textInput" placeholder="Enter Your E-mail" required></td>
            </tr>
            <tr>
              <td>Password : </td>
              <td><input type="password" name="password" class="textInput" placeholder="Enter Password" required></td>
            </tr>
            <tr>
              <td>Confirm Password : </td>
              <td><input type="password" name="password2" class="textInput" placeholder="Confirm Password" required></td>
            </tr>
          </table>
          <br>
          <button type="submit" name="register_btn" class="btn btn-success ">Send OTP</button>
        </form>
        <br>
        <div class="message">
          <?php
          echo $msg;
          ?>
        </div>
        <div id="hide">
          <form method="POST">
            <table>
              <tr>
                <td>Enter OTP : </td>
                <td><input type="text" id="otp" name="otp" class="textInput" placeholder="Enter OTP" required></td>
              </tr>
            </table>
            <br>
            <input type="submit" value="Register" name="otp_btn" class="btn btn-success ">

          </form>
        </div>
        <div class="message">
          <?php
          echo $regmsg;
          ?>
        </div>
      </center>
      <div class="text-center">Already have an account? <a href="login.php">Sign In</a></div>
    </div>
  </main>
  <script>
    function show() {
      document.getElementById("hide").style.display = "block";
    }
  </script>
</body>

</html>
