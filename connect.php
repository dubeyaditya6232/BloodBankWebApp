<?php
$localhost="localhost";
$username="root";
$password="";
$DBname="bbms";
$db=new mysqli($localhost,$username,$password,$DBname);
// Check connection
if ($db->connect_error) {
  die( "Failed to connect to MySQL" .$db->connect_error);
}
?>