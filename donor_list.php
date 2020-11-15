<?php
// Turn off all error reporting
error_reporting(0);
include('connect.php');
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "index.php";
</script>';
}
if($_SESSION['username']===null)
{
    echo "<html><body><a href='login.php'>Login</a><br></body></html>";
    die("You are not logged IN");
    //header("location:login.php");// redirect to login page
}

else{
  header("location:display.php");
}
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
<style>
body {
  font-family: "Lato", sans-serif;
}
table, th, td {
    padding: 2em;
    text-align: center;
    border: 3px solid black;
}
table{
    width:100%;
    height:max-content;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
body{
  background-color: #e6ffff;
}
@media only screen and (max-width: 600px) {
  h1{
    font-size: 2rem;
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
      <a class="navbar-brand" href="index.php">Start</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="login-page.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="search-donor.php"><span class="glyphicon glyphicon-search"></span>  Search Donor  </a></li>
        <li><a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span>  Donor List  </a></li>
        <li><a href="my-profile.php"><span class="glyphicon glyphicon-wrench"></span>  My Profile  </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">BLOOD BANK MANAGEMENT SYSTEM</h1><br>
  </hgroup>
<main class="main-content">
 <div class="col-md-6 col-md-offset-4">
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
</div>
</main>
</div>  
</body>
</html> 