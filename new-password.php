<?php
session_start();

include('connect.php');
if (isset($_POST['continue_btn'])) {
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
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Password</title>
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
        <div id="UserLogin" class="container tab-pane  active " role="tabpanel" aria-labelledby="newPass-tab">
        <form method="POST">
            <h2> Create New Password </h2>
            <hr style="border: 1px solid black;">
            <div class="form-group">
              <span>
                <font color="red"><b> Enter New Password : </b></font>
              </span>
              <input type="password" name="new_pass" class="textInput form-control" style="width:250px;"  required>
              <br>
              <span>
                <font color="red"><b> Confirm Password : </b></font>
              </span>
              <input type="password" name="confirm_pass" class="textInput form-control" style="width:250px;" required>
            <br><br>
            <button name="continue_btn" class="btn btn-success">Continue to Login</button>
            </div>
        </form>
        </div>
        </div>
    </center>
  </main>
</body>
</html>