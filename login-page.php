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
if(isset($_POST['del_request_btn']))
{
  $query = "UPDATE users
  SET Request='0',
      reqbg='NULL',
      date='0000-00-00'
  WHERE username='$username'";
  if($db->query($query)===true)
  {
    //echo " Updated Active Users";
  }
}
if(isset($_POST['request_btn']))
{
    $reqbg=$_POST["bgroup"];
    
    $mydate=getdate(date("U"));
    $cmonth=$mydate['mon'];
    $cday=$mydate['mday'];
    $cyear=$mydate['year'];
    $date=$_POST['date'];
    $dateElements = explode('-', $_POST['date']);
    $Emonth=$dateElements[1];
    $Eday=$dateElements[2];
    $Eyear=$dateElements[0];
    //echo $date;
    if($Eyear>=$cyear)
    {
        if($Emonth>=$cmonth)
        {
            if($Eday>=$cday)
            {
                $sql="UPDATE users SET date='$date',reqbg='$reqbg' WHERE username = '$username' ";
                if($db->query($sql)===true){
                  //$Reqmsg="Request updated successfully !";
              }
                $query = "UPDATE users SET Request='1' WHERE username = '$username'";
                if($db->query($query)===true){
                    $Reqmsg="Request updated successfully !";
                }
                else{
                $Reqmsg="Error updating the Request :".$db->error;
                }
            }
            else{
                $Reqmsg="Enter Valid Date !!";
            }
        }
        else{
            $Reqmsg="Enter Valid Date !!";
        }
    }
    else{
        $Reqmsg="Enter Valid Date !!";
    }
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
  .a{
    max-width: 270px;
  }
}
@media only screen and (max-width: 600px) {
  h1{
    font-size: 2rem;
  }
  img{
    max-width: 270px;
  }
}
</style>
</head>
<body>
<!--<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php"> Start</a>
  <a href="login-page.php"><span class="glyphicon glyphicon-home"></span> Home</a>
  <a href="search-donor.php"><span class="glyphicon glyphicon-search"></span> Search Donor</a>
  <a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span> Donor List</a>
  <a href="my-profile.php"><span class="glyphicon glyphicon-wrench"></span> My Profile</a>
  <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>-->
  
  <!--<hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">BLOOD BANK MANAGEMENT SYSTEM</h1><br>
  </hgroup>-->
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


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<div class="container-fluid">
<main class="main-content">
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<div class="container">

<div class="row">
    <div class="col-md-8">
      <img src="img/blood-types-chart.jpg" alt="blood chart">
      <br><br>
    </div>
    
    <div class="col-md-4 " >
    <div class="container-fluid a" style="border: 4px solid black;">
      <p><h2 style="color: red;text-align:center;">Make Request</h2></p>
      <br>
    <form method="post">
       <table>
       <label for="bgroup">Select Blood Group : </label>
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
       <div class="form-group">
           <br>
           <label>Enter Date Of Requirement</label>
       <input type="date" class="form-control" name="date" placeholder="dd/mm/yy" required="required">
       </div>
       
         <center><input type="submit" name="request_btn" value="Make Request"></center>      
      </table>
      
      </form>
      <br>
      <form method="post">
          <center><input  type="submit" name="del_request_btn" value="Undo Request"></center>
      </form>
      <br>
      <?php
      if(isset($_POST['request_btn']))
      {
      echo $Reqmsg;
      }
      ?>
    </div>
    </div>
    
</div>

</div>

</main>
</div>  
</body>
</html> 


