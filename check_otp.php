<?php
session_start();
$con=mysqli_connect('localhost','root','','bbms');
$otp=$_POST['otp'];
$email=$_SESSION['EMAIL'];
$res=mysqli_query($con,"select * from otp_store where email = '$email' and otp = '$otp'");
$count=mysqli_num_rows($res);
if ($count>0)){
   mysqli_query($con,"update otp_store set otp = '' where email = '$email'");
   echo "Valid";
}
else{
    echo "Invalid";
}
?>