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
    if(isset($_POST['select_btn']))
    {
    $bgroup=$_POST['bgroup'];// $bgroup stores the blood group which user selects.
    $sql= "SELECT * FROM users WHERE bgroup='$bgroup' AND usertype= 'donor'";// bgroup is a coulmn in user table.
    $result=$db->query($sql);
    echo '<div class="row">';
    if ($result->num_rows > 0)
    {
      $true=1;
    } 
    else {
        $msg= "Sorry, No Donors Found";
      }
      echo '</div>';
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
  background-color: #e6ffff;
}
.a table{
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
  <div class="container-fluid">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">You Can Not succeed without Trying</h1><br>
  </hgroup>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="login-page.php"><span class="glyphicon glyphicon-home"></span> Home</a>
  <!--<a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>-->
  <a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span> Donor List</a>
  <a href="my-profile.php"><span class="glyphicon glyphicon-wrench"></span> My Profile</a>
  <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<main class="main-content">

 <div class="col-md-6 col-md-offset-2">

<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>

<center>
<form method="post" action="search-donor.php">
  <table>
  <label for="bgroup">Select Blood Group: </label>
<select name="bgroup">
  <option value="O+">O+</option>
  <option value="O-">O-</option>
  <option value="AB+">AB+</option>
  <option value="AB-">AB-</option>
  <option value="A+">A+</option>
  <option value="A-">A-</option>
  <option value="B+">B+</option>
  <option value="B-">B-</option>
</select> 
<br>          
    <input type="submit" name="select_btn">
    </table>

</form>
</center>
<br>
<br>
<?php
if(isset($_POST['select_btn']))
{
    if($result->num_rows < 1)
    {
        echo '<p style="text-align:center">'.$msg.'</p>';
        unset($msg);
    }
}
?>
</div>
</main>
</div>

</body>
</html>
<?php
 if($true=1)
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
?>

