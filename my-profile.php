<?php
session_start();
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
</style>
</head>
<body>
  <div class="container-fluid">
  <hgroup>
    <h2 class="site-title" style="text-align:center; color: Red;">Welcome  <?php echo $data['Name']?></h2><br>
  </hgroup>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
  <a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span> Donor List</a>
  <!--<a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>-->
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
</script>
<main class="main-content">
 <div class="col-md-6 col-md-offset-5">
<?php
    //$qry = mysqli_query($db,"select * from users where username='$username'");// select query
    //$data = mysqli_fetch_array($qry); // fetch data
    //if(isset($_SESSION['message']))
    //{
        // echo "<div id='error_msg'>".$_SESSION['message']."</div>";
        // unset($_SESSION['message']);
    //}
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
<p><h3 style="color: red;">Step Ahead,Save Life,Donate Blood.</h3></p>

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