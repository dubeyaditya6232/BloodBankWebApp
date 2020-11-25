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
    min-height:25rem;
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
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container-fluid">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">Blood stock</h1><br>
  </hgroup>
<main class="main-content">

<!-- Adding new blood stock details-->
<center>
<div>
    <p> Add details of new blood Stock</P>
    <a href="new-details.php" class="btn btn-success" role="button">Add New Details</a>
</div>
</center>
<hr style="border: 1px solid black">
<!-- end of adding new blood stock details-->
<?php
if($true===1)
{
    $sql="SELECT * FROM bloodstock";
    $result=$db->query($sql);
    if ($result->num_rows > 0)
    {

    echo '<div class="container-fluid">';//container opened
    echo '<div class="row">';//Row opened
    while($row = $result->fetch_assoc()) {
    echo '<div class="col-lg-3 col-sm-3">';
    echo '<div class="card">';
    echo '<div class="card-block">';
      echo '<h4 class="card-title " style="color:green;">Status : '.$row['status'].'</h4>';
      echo '<p style="color:black;">Blood Group : '.$row['bgroup'].'</p>';
      echo '<p style="left:0;color:black;">Address :</p>';
      echo '<p>'.$row['address'].'</p>';
      echo '<a style="position:absolute;bottom:2rem;right:2rem;" href="update.php?ID='.$row["ID"].'" class="btn btn-danger" role="button">Update</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    }
    echo '</div>';//Row closed
    echo '</div>';//container closed
    }
    
else{
    echo '<p class="text-center " style="color:red;">No information Available for blood Stock</p>';
}
}
?>
</main>
</div>  
</body>
</html>