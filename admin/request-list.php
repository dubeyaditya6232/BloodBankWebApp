<?php
// Turn off all error reporting
error_reporting(0);
include('../connect.php');
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "../index.php";
</script>';
}

else{
    $true=1;
  //header("location:display.php");
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
  background-color: #cceabb;
}
.card {
  padding: 1em;
	background: white;
	box-shadow: 0 3px 10px blueviolet;
  margin-bottom:1em;
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
      <a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-home"></span> Start</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">Active Request Available</h1><br>
  </hgroup>
<main class="main-content">
 <div class="row">
<?php
if($true===1)
{
    $sql="SELECT * FROM users WHERE Request='1'";
    $result=$db->query($sql);
    if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc()) {
    echo '<div class="col-lg-3 col-sm-3">';
    echo '<div class="card">';
    echo '<div class="card-block">';
      echo '<h4 class="card-title">Name : '.$row["Name"].'</h4>';
      echo '<p>City : '.$row["City"].'</p>';
      echo '<p>Gender : '.$row["Gender"].'</p>';
      echo '<p>Age : '.$row["Age"].'</p>';
      echo '<p style="color:Red;">Blood Group Required: '.$row["reqbg"].'</p>';
      echo '<p style="color:Red;">Date of Requirement: '.$row["date"].'</p>';
      echo '<p>Mobile No. : '.$row["mobile"].'</p>';
      echo '<p>E-mail : '.$row["Email"].'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
  }
}
    
else{
    echo '<p class="text-center " style="color:red;">No Active Request </p>';
  }
}
?>
</div>
</main>
</div>  
</body>
</html> 