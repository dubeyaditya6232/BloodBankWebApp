<?php
session_start();

include('connect.php');
if (isset($_POST['continue_btn'])) {
    $pwd = mysqli_real_escape_string($db, $_POST['new_pass']);
    $cpwd = mysqli_real_escape_string($db, $_POST['confirm_pass']);
    $_SESSION['pwd']=$pwd;
    $_SESSION['cpwd']=$cpwd;
    $email = $_SESSION['email'];
    if($pwd == $cpwd){
        $pwd=md5($pwd);
        mysqli_query($db, "UPDATE users SET password = '$pwd' where Email = '$email'");
        echo '<script>alert("Password Reset Successfully");
        window.location.href = "login.php";
        </script>';
    } else {
      echo '<script>alert("two Passwords do not  match");</script>';
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
            <div class="form-group third_box">
              <span>
                <font color="red"><b> Enter New Password : </b></font>
              </span>
              <input type="password" name="new_pass" class="textInput form-control"  required>
              <br>
              <span>
                <font color="red"><b> Enter New Password : </b></font>
              </span>
              <input type="password" name="confirm_pass" class="textInput form-control" required>
            <br>
            <button name="continue_btn" class="btn btn-success">Continue to Login</button>
            </div>
          </form>
</body>
</html>