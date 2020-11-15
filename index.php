<?php
session_start();

include('connect.php');

//$reqbg=$_POST["bgroup"];
//$username= $_SESSION["username"];
$mydate=getdate(date("U"));
$cmonth=$mydate['mon'];
$cday=$mydate['mday'];
$cyear=$mydate['year'];
$sql2= "SELECT date FROM users WHERE Request='1'";
$result1=$db->query($sql2);
if($result1->num_rows>0)
{
  while($row1= $result1->fetch_assoc())
  {
    //echo $row1["date"];
    $date1 = date_create();
    $date1= $row1["date"];
    $dateElements = explode('-', $date1);
    $Emonth=$dateElements[1];
    $Eday=$dateElements[2];
    $Eyear=$dateElements[0];
    //echo $Eday;
    //echo date("Y-m-d",strtotime($date1));

    if($Eyear<=$cyear)
    {
        if($Emonth<=$cmonth)
        {
            if($Eday<$cday)
            {
              $query1 = "UPDATE users
              SET Request='0',
                  reqbg='NULL',
                  date='NULL'
              WHERE date =' ".$row1["date"]." '";
              if($db->query($query1)===true)
              {
                //echo " Updated Active Users";
              }
            }
        }
    }
  }
}





$sql="SELECT * FROM users  WHERE Request='1'";
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
body{
  background-color: #e6ffff;
}
.card {
  padding: 1em;
	background: white;
	box-shadow: 0 3px 10px blueviolet;
}
.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  background-color: yellow;
  padding: .4rem;
  font-size: 20px;
  text-align: center;
}
@media only screen and (max-width: 600px) {
  h1{
    font-size: 2rem;
  }
  h2{
    font-size: 2rem;
  }
  .sticky{
    font-size: 10px;
  }
}
.donationTypeInfoWindow {
    background-color: #e6ffff;
    border: 2px solid black
}
</style>
</head>
<body>



<div class="sticky">Note: Your Request will be removed After the Date of requirement is passed.</div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="about-us.html"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
  <hgroup>
    <h1 class="site-title" style="text-align: center; color: Red;">BLOOD BANK MANAGEMENT SYSTEM</h1>
  </hgroup>
<hr>
<main class="main-content container-fluid">
  <p><h2 class="text-center" style="color: Red;">Active Requests Available</h2></p>
  
  <br>
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
    echo '<p class="text-center" style="color:Red;text-align:centre;">No User Has Requested for Blood</p>';
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
<br>
<!--<p style="text-align: center;">This page is not yet ready and will be updated later, you can still use the menu option for navigation.</p>
<p style="text-align: center;">you can register as a new user or login using the details provided to explore site.</p>
<p style="text-align: center;">Username : adi</p>
<p style="text-align: center;">Password : 123</p>
<br>
</div>-->


<!--
<div class="col-md-8 col-md-offset-2 donationTypeInfoWindow text-center">
			<header class="typeHeading">
				<h1>Types of donation</h1>
			</header>
			<div class="content">
                <p style="text-align: center;">The human body contains five liters of blood, which is made of several useful components i.e. <strong>Whole blood</strong>, <strong>Platelet</strong>, and <strong>Plasma</strong>.</p>
                <p style="text-align: center;">Each type of component has several medical uses and can be used for different medical treatments. your blood donation determines the best donation for you to make.</p>
                <p style="text-align: center;">For <strong>plasma</strong> and <strong>platelet</strong> donation you must have donated whole blood in past two years.</p>
                							
            </div>
            <br><br>

    <h1 style="color: red;">WHITE BLOOD CELLS</h1>
		<div class="row">
		<div class="col-md-4 ">
		
			<h3>What is it?</h3>
			
			<p>
			Blood Collected straight from the donor after its donation usually separated into red blood cells, platelets, and plasma.</p>
			
			<h3>Who can donate?</h3>
			
			<p>You need to be 18-65 years old, weigh 45kg or more and be fit and healthy.</p>
		

		</div>
		<div class="col-md-4 infoContent">
		<h3>User For?</h3>
			
			<p>
			 Stomach disease, kidney disease, childbirth, operations, blood loss, trauma, cancer, blood diseases, haemophilia, anemia, heart disease.</p>
			
			<h3>Lasts For?</h3>
			
			<p>Red cells can be stored for 42 days.</p>
		
		</div>
		<div class="col-md-4 ">
		<h3>How long does it take?</h3>
			
			<p>
			15 minutes to donate.</p>
			
			<h3>How often can I donate?</h3>
			
			<p>Every 12 weeks</p>
		
		</div>
		</div>
		
    <h1>PLASMA</h1>
    <div class="row">
		<div class="col-md-4 ">
		
			<h3>What is it?</h3>
			
			<p>
			The straw-coloured liquid in which red blood cells, white blood cells, and platelets float in.Contains special nutrients which can be used to create 18 different type of medical products to treat many different medical conditions.</p>
			
			<h3>Who can donate?</h3>
			
			<p>You need to be 18-70 (men) or 20-70 (women) years old, weigh 50kg or more and must have given successful whole blood donation in last two years. </p>
		

		</div>
		<div class="col-md-4 infoContent">
		<h3>User For?</h3>
			
			<p>
			Immune system conditions, pregnancy (including anti-D injections), bleeding, shock, burns, muscle and nerve conditions, haemophilia, immunisations.</p>
			
			<h3>Lasts For?</h3>
			
			<p>Plasma can last up to one year when frozen.</p>
		
		</div>
		<div class="col-md-4 ">
		<h3>How  does it work?</h3>
			
			<p>
			We collect your blood, keep plasma and return rest to you by apheresis donation.</p>
		
		<h3>How long does it take?</h3>
			
			<p>
			15 minutes to donate.</p>
			
			<h3>How often can I donate?</h3>
			
			<p>Every 2-3 weeks.</p>
		
		</div>
		</div>
		<h1>PLATELETS</h1>
		<div class="row">
		<div class="col-md-4 ">
		
			<h3>What is it?</h3>
			
			<p>
			The tiny 'plates' in blood that wedge together to help to clot and reduce bleeding. Always in high demand, Vital for people with low platelet count, like malaria and cancer patients.</p>
			
			<h3>Who can donate?</h3>
			
			<p>You need to be 18-70 years old (men), weigh 50kg or more and have given a successful plasma donation in the past 12 months</p>
		

		</div>
		<div class="col-md-4 infoContent">
		<h3>User For?</h3>
			
			<p>
			Cancer, blood diseases, haemophilia, anaemia, heart disease, stomach disease, kidney disease, childbirth, operations, blood loss, trauma, burns.</p>
			
			<h3>Lasts For?</h3>
			
			<p>Just five days..</p>
		
		</div>
		<div class="col-md-4 ">
		<h3>How does it work?</h3>
			
			<p>
			We collect your blood, keep platelet and return rest to you by apheresis donation.</p>
			
		<h3>How long does it take?</h3>
			
			<p>
			45 minutes to donate.</p>
			
			<h3>How often can I donate?</h3>
			
			<p>Every 2 weeks</p>
		
		</div>
		</div>
		<br><br>

</div>-->



<?php
include("footer.php");
?>
</body>
</html>
