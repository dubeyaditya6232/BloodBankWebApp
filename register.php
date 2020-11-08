<?php
session_start();
include('connect.php');
//connect to database
//$db=mysqli_connect("localhost","id15197072_bbms","123456789@aA","id15197072_root1");

if(isset($_POST['register_btn']))
{
    $name=$_POST['name'];
    $city=$_POST['city'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $bloodgrp=$_POST['bgroup'];
    $username=$_POST['username'];
    $mno=$_POST['mno'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];  
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result=mysqli_query($db,$query);
      if($result)
      {
     
        if( mysqli_num_rows($result) > 0)
        {
                
                echo '<script language="javascript">';
                echo 'alert("Username already exists")';
                echo '</script>';
        }
        
          else
          {
            
            if($password==$password2)
            {           //Create User
                $password=md5($password); //hash password before storing for security purposes
                $sql="INSERT INTO users(name, city, gender, age, bgroup, username, password , mobile ,Email  ) 
                                 VALUES('$name','$city','$gender','$age','$bloodgrp','$username','$password','$mno','$email')"; 
                /*if($db->query($sql)===TRUE)
                {
                  echo "USER Registered Successfully";
                }
                else{
                  echo "error: ".$sql."<br>".$db->error;
                }*/
                /*mysqli_query($db,$sql);  
                $_SESSION['message']="USER Registered Successfully"; 
                $_SESSION['username']=$username;
                header("location:index.php");  //redirect home page*/
            }
            else
            {
                $_SESSION['message']="The two password do not match";   
            }
          }
      }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aditya Dubey</title>
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
   padding-top:10px;
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
  </style>
</head>
<body>

<div class="container">
  <hgroup>
  <h2 class="site-title" style="text-align: center; color: red;">Blood Bank Registration Form</h2><br>
  </hgroup>

<br>
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


<main class="main-content">
<p class="text-center">Registering for this site is easy. Just fill the fields below,and well get a new account set up for free and in no time.</p>
<br><br>
 

<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<div>
<center>
<p>All fields are mandatory</p>
  <form method="post" action="register.php">
  <table>
     <tr>
           <td>Name : </td>
           <td><input type="text" name="name" class="textInput" placeholder="Enter Your Name" required></td>
     </tr>
     <tr>
           <td>City : </td>
           <td><input type="text" name="city" class="textInput" placeholder="Enter City Name" required></td>
     </tr>
     <tr>
           <td>Gender : </td>
           <td><input type="text" name="gender" class="textInput" placeholder="Enter Your Gender" required></td>
     </tr>
     <tr>
           <td>Age : </td>
           <td><input type="text" name="age" class="textInput" placeholder="Enter Your Age" required></td>
     </tr>
     <tr>
     <td><label for="bloodgroup" >Blood Group: </label></td>
     <td><select name="bgroup" required>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
     </select></td>
     </tr>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput" placeholder="Enter Your Username" required></td>
     </tr>
     <tr>
           <td>mobile No. : </td>
           <td><input type="text" name="mno" class="textInput" placeholder="Enter Your Mobile No." required></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput" placeholder="Enter Your E-mail" required></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput" placeholder="Enter Password" required></td>
     </tr>
      <tr>
           <td>Confirm Password : </td>
           <td><input type="password" name="password2" class="textInput" placeholder="Enter Password Again"required></td>
     </tr>      
    </table>
    <br>
    <input type="submit" name="register_btn" class="Register ">
</form>
</center>
<div class="text-center">Already have an account? <a href="login.php">Sign In</a></div>
<?php
if(isset($_POST['register_btn']))
{
   if($db->query($sql)===TRUE)
     {
       echo "USER Registered Successfully";
       echo '<span>proceed to  <span><a href="Login.php">LogIn</a>';
      }
    else{
       echo "error: ".$sql."<br>".$db->error;
      }
    }
?>
</div>

</main>
</div>

</body>
</html>




