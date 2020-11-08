<?php
session_start();

include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aditya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <style>
  #error_msg
{
    width:50%;
    margin:5px auto;
    height:30px;
    border:1px solid #FF0000;
    background:red;
   color:#FF0000;
   text-align:center;
   padding:1em;
}

  
</style>
</head>
<body>

<div class="container">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: green;">BLOOD BANK MANAGEMENT SYSTEM</h1><br>
  </hgroup>

<br>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  <!-- Collect the nav links, forms, and other content for toggling -->
    <div class=" navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav center">
        <li><a href="index.php">Home</a></li>
        <!--<li><a href="login.php">LogIN</a></li>
        <li><a href="register.php">SignUp</a></li>
        <li><a href="logout.php">LogOut</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
      </div>
  </div>
</nav>


<main class="main-content">
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<p style="text-align: center;">This page is not yet ready and will be updated later, you can still use the menu option for navigation.</p>
<p style="text-align: center;">you can register as a new user or login using the details provided to explore site.</p>
<p style="text-align: center;">Username : adi</p>
<p style="text-align: center;">Password : 123</p>
</main>
</div>
<?php
include("footer.php");
?>
</body>
</html>
