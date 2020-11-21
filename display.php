<?php
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "index.php";
</script>';
}
include('connect.php');
$sql="SELECT * FROM users  WHERE usertype= 'donor'";
$result=$db->query($sql);
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
  

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/996973c893.js"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;500;600;700;800&family=Roboto+Slab:wght@200;400;600;900&display=swap"
      rel="stylesheet"/>
<style>
body {
  font-family: "Lato", sans-serif;
  background-color: #e6ffff;
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

/*Styling of cards*/
/*.container-fluid { max-width: 1200px; }*/

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
  <!-- <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">Every blood donor is a life saver.</h1>
    <hr>
  </hgroup> -->
<main class="main-content container-fluid">
 <div class="row">
    <?php
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
      echo '<p>Blood Group : '.$row["bgroup"].'</p>';
      echo '<p>Mobile No. : '.$row["mobile"].'</p>';
      echo '<p>E-mail : '.$row["Email"].'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
  }
}
    
else{
    echo "No User Found as Donor";
  }
  ?>
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


<!--creating card-->


<!--if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc()) {
    echo '<div class="col-lg-4 col-sm-4">';
    echo '<div class="card">';
    echo '<div class="card-block">';
      echo '<h2 class="card-title">Name'.$row["Name"].'</h2>';
      echo '<p>City'.$row["City"].'</p>';
      echo '<p>Gender'.$row["Gender"].'</p>';
      echo '<p>Age'.$row["Age"].'</p>';
      echo '<p>Blood Group'.$row["bgroup"].'</p>';
      echo '<p>Mobile No.'.$row["mobile"].'</p>';
      echo '<p>E-mail'.$row["Email"].'</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
}
-->
<!--if ($result->num_rows > 0)
  {
  echo '<thead>';
  echo '<tr>';
  echo '<th scope="col">ID</th>';
  echo '<th scope="col">Name</th>';
  echo '<th scope="col">City</th>';
  echo '<th scope="col">Gender</th>';
  echo '<th scope="col">Age</th>';
  echo '<th scope="col">Blood Group</th>';
  echo '<th scope="col">Mobile No.</th>';
  echo '<th scope="col">E-mail</th>';
  echo '</tr>';
  echo'</thead>';
   
  while($row = $result->fetch_assoc()) {
    echo "<tbody>";
    echo "<tr>";
    echo  '<th scope="row">'.$row["ID"].'</th>';
    echo  '<td>'.$row["Name"].'</td>';
    echo  '<td>'.$row["City"].'</td>';
    echo  '<td>'.$row["Gender"].'</td>';
    echo  '<td>'.$row["Age"].'</td>';
    echo  '<td>'.$row["bgroup"].'</td>';
    echo  '<td>'.$row["mobile"].'</td>';
    echo  '<td>'.$row["Email"].'</td>';
    echo  '</tr>';
    echo '</tbody>';
  }
}-->