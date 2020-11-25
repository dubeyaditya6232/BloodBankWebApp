<?php
session_start();
error_reporting(0);
if($_SESSION['Admin']==='YES')
header("location:admin/admin.php");
else if(  isset($_SESSION['username']) )
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
if(isset($_POST['Adminlogin_btn']))
{
  $username1=mysqli_real_escape_string($db,$_POST['username']);
  $password1=mysqli_real_escape_string($db,$_POST['password']);
  $password1=md5($password1);
  $sql2="SELECT * FROM users WHERE  Admin='YES'";
  $result2=$db->query($sql2);
  if($result2->num_rows<1)
  {
    echo '<script type="text/javascript">alert("You are not Authenticated");
    window.location.href = "login.php";
   </script>';
  }
  else
  {
    $sql1="SELECT * FROM users WHERE  username='$username1' AND password='$password1'";
  $result1=mysqli_query($db,$sql1);
  if( mysqli_num_rows($result1)>=1)
  {
    $_SESSION['username']=$username1;
    $_SESSION['Admin']='YES';
    echo '<script type="text/javascript">alert("loggedIN as Admin");
    window.location.href = "admin/admin.php";
   </script>';
  }
  else
  {
    echo '<script type="text/javascript">alert("User Name Password Incorrect");
    window.location.href = "login.php";
   </script>';
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
.nav-tabs > li {
    float:none;
    display:inline-block;
    zoom:1;
}

.nav-tabs {
    text-align:center;
}
#logo1 img
{    
    height: 50px;
    
}
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
<div id="logo1"> 
    <center><img class="img-responsive" src = "img/logo.jpg" alt = "RAKTIM"></center>
</div>
<br>
<main class="main-content" >
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div class='text-center'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<center>
  <ul class="nav nav-tabs "  role="tablist" >
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#UserLogin">User Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#AdminLogin">Admin Login</a>
    </li>
  </ul>
  <div class="tab-content">
     <div id="UserLogin" class="container tab-pane  active" role="tabpanel" aria-labelledby="UserLogin-tab">
        <form method="post" action="login.php">
           <h1>  User Login  </h1>
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
               <input type="Submit" name="login_btn" class="btn btn-primary">
        </form>
              <br>
              <div>Do not have an account? <a type="submit" href="register.php">Sign up</a></div>
      </div>
      <div id="AdminLogin" class="container tab-pane fade" role="tabpanel"aria-labelledby="AdminLogin-tab">
            <form method="post" action="login.php">
                 <h1 > Admin Login  </h1>
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
                   <input type="Submit" name="Adminlogin_btn" class="btn btn-primary">
            </form>
              <br>
              
       </div>
  </div>
  </center>

  

</main>
</script>
</body>
</html>
