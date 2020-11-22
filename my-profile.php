<?php
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "index.php";
</script>';
}
include('connect.php');
$username= $_SESSION["username"];
if(isset($_POST['update']))
{
  $usertype=$_POST['usertype'];
  $query = "UPDATE users SET usertype='$usertype' WHERE username = '$username'";
  if($db->query($query)===true){
  $msg="Record updated successfully !";
  }
  else{
    $msg="Error updating the Record :".$db->error;
  }
}
    $qry = mysqli_query($db,"select * from users where username='$username'");// select query
    $data = mysqli_fetch_array($qry); // fetch data
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
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
table, th, td {
    padding: 2em;
    text-align: center;
    border: 3px solid black;
}
table{
    width:100%;
    height:max-content;
}
img{
  width: 25%;
}
@media only screen and (max-width: 600px) {
  h2{
    font-size: 2rem;
  }
  .a{
    left:0px;
  }
  img{
    width:50%;
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
  <div>
  <center><img class="img-responsive"src ="img\logo.jpg" alt ="RAKTIM" ></center>
  </div>
  <hgroup>
    <h2 class="site-title" style="text-align:center; color: Red;">Welcome  <?php echo $data['Name']?></h2><hr>
  </hgroup>

<!--<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="login-page.php"><span class="glyphicon glyphicon-home"></span> Home</a>
  <a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span> Donor List</a>
  <a href="search-donor.php"><span class="glyphicon glyphicon-search"></span> Search Donor</a>
  <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
<br>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>-->
<main class="main-content  a">
  
 <div class="col-md-6 " style="left:1rem;font-size:2rem">
<?php
    if(isset($_SESSION['message']))
    {
        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<!-- Displaying personal data type-->
<div>
  <p>Name : <?php echo $data['Name']?></p>
  <p>City : <?php echo $data['City']?></p>
  <p>Gender : <?php echo $data['Gender']?></p>
  <p>Age : <?php echo $data['Age']?></p>
  <p>Blood Group : <?php echo $data['bgroup']?></p>
  <p>User Type : <?php echo $data['usertype']?></p>
  <p>UserName : <?php echo $data['username']?></p>
  <p>Mobile No : <?php echo $data['mobile']?></p>
  <p>E-mail : <?php echo $data['Email']?></p>
  <br>
</div>
<!-- Editing User Type-->

 </div>
 
 <div class="col-md-6 " style="font-size:2rem;">
 <p><h2 style="color: brown;">Step Ahead, Save Life, Donate Blood.</h2></p>
 <br>
 
<form method="POST">
  <div>
  <label for="usertype" >User Type: </label>
  <select name="usertype" required>
     <option value="Donor">Donor</option>
     <option value="Recipient">Recipient</option>
  </select>
  </div>
  <input type="submit" name="update" value="Update">
</form>
<br>
<br>
<?php
if(isset($_POST['update'])){
  echo $msg;
}
?>
</div>
</main>
</div>  
</body>
</html>