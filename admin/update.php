<?php
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "../index.php";
</script>';
}
include('../connect.php');
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
.a{
    width:30em;
    border:2px solid black;
    padding:2rem;
}
@media only screen and (max-width: 600px) {
  h1{
    font-size: 2rem;
  }
  .a{
    width:25rem;
  }
  .card{
    min-height:fit-content;
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
        <li><a href="blood-stock.php"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="admin.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
<main class="main-content">
 <center>
 <p><h4 style="color:red;">Updation form for blood stock</h4></p>
 <form METHOD="POST">
<div class="row a">

    <div class="form-group">
      <label for="state">State: </label>
      <input type="text" class="form-control"  placeholder="Enter state" name="state" required>
    </div>


    <div class="form-group">
      <label for="city">City: </label>
      <input type="text" class="form-control"  placeholder="Enter City" name="city" required>
    </div>


    <div class="form-group">
      <label for="address">Address: </label>
      <input type="text" class="form-control"  placeholder="Enter Address" name="address" required>
    </div>

<br>
    <input type="submit" name="update-stock-btn" class="btn btn-primary" Value="update">

</div>
</form>
</center>

</main>
</div>  
</body>
</html> 
<?php
  if(isset($_POST['update-stock-btn']))
  {
      $state=$_POST['state'];
      $city=$_POST['city'];
      $address=$_POST['address'];
    $sql="UPDATE bloodstock SET State='$state',City='$city',address='$address'  WHERE ID='".$_GET['ID']."'";
    if($db->query($sql)===true){
      echo '<script>window.location.href = "blood-stock.php";</script>';
      }
  }
?>