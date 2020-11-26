<?php
session_start();
if(!$_SESSION)
{
 echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "../index.php";
</script>';
}
include('../connect.php');
//print_r($_GET);
$sql="DELETE FROM users WHERE ID='".$_GET['ID']."'";
if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $db->error;
  }
  echo '<script>window.location.href = "users-list.php";</script>';
?>