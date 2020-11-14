<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location:login-page.php");
  die();
}
include('connect.php');

if($db)
{
  if(isset($_POST['login_btn']))
  {
      $username=mysqli_real_escape_string($db,$_POST['username']);
      $password=mysqli_real_escape_string($db,$_POST['password']);
      $password=md5($password); //Remember we hashed password before storing last time
      $sql="SELECT * FROM users WHERE  username='$username' AND password='$password'";
      $result=mysqli_query($db,$sql);
      
      if($result)
      {
     
        if( mysqli_num_rows($result)>=1)
        {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['username']=$username;
            header("location:login-page.php");
        }
       else
       {
              $_SESSION['message']="Username and Password incorrect";
       }
      }
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
  <link rel="stylesheet" href="style.css">
  <style>
  /*#error_msg
{
    width:50%;
    margin:5px auto;
    height:30px;
    border:1px solid #FF0000;
   color:#FF0000;
   text-align:center;
   padding-top:10px;
}*/
table { 
 border-collapse: collapse; 
  }
th ,td{
  padding: 0.5rem;
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
      <!--<P class="navbar-brand">Menu</P>-->
      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">About Us</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="main-content" >
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<center>
<div>
<form method="post" action="login.php">
<h1 class="site-title" style="text-align: center; color: Red;">  Log In  </h1>
  <table>
     <tr>
           <td><p><font color="red"><b>Username : </b></font></p></td>
           <td><input type="text" name="username" class="textInput" required></td>
     </tr>
      <tr>
           <td><p><font color="red"><b>Password : </b></font></p></td>
           <td><input type="password" name="password" class="textInput" required></td>
     </tr> 
</table>
<br>
<input type="Submit" name="login_btn" class="Log In">
</form>
</div>
</center>
<br>
<div class="text-center">Do not have an account? <a href="register.php">Sign up</a></div>
</main>
</div>

</body>
</html>
