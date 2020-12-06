<?php
session_start();
if (!$_SESSION) {
  echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "index.php";
</script>';
}
include('connect.php');
$username = $_SESSION["username"];
if (isset($_POST['update'])) {
  $usertype = $_POST['usertype'];

  $result = $db->query("SELECT * FROM users WHERE username ='$username'");
  $row = $result->fetch_array();
  $currentdate = date("Y/m/d");
  $currentdate = date_create($currentdate);
  $fetchdate = $row['lbddate'];
  $fetchdate = date_create($fetchdate);
  $diff = date_diff($currentdate, $fetchdate);
  $diff2 = $diff->format("%a");
  $age = $row['Age'];
  if ($age >= 18 && $age <= 65) {
    if ($diff2 > 90) {

      $query = "UPDATE users SET usertype='$usertype' WHERE username = '$username'";
      if ($db->query($query) === true) {
        $msg = "User Type updated successfully !";
      } else {
        $msg = "Error updating the Record :" . $db->error;
      }
    } else {
      $msg = "You cannot donate blood twice within 90 days";
    }
  } else {
    $msg = "Only people between age 18 and 65 are eligible for Blood Donation";
  }
}
$qry = mysqli_query($db, "select * from users where username='$username'"); // select query
$data = mysqli_fetch_array($qry); // fetch data
if (isset($_SESSION['message'])) {
  echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
  unset($_SESSION['message']);
}
if (isset($_POST['last-bd-update-btn'])) {
  $mydate = getdate(date("U"));
  $cmonth = $mydate['mon'];
  $cday = $mydate['mday'];
  $cyear = $mydate['year'];
  $date = $_POST['lastbddate'];
  $dateElements = explode('-', $_POST['lastbddate']);
  $Emonth = $dateElements[1];
  $Eday = $dateElements[2];
  $Eyear = $dateElements[0];
  if ($Eyear <= $cyear && $Emonth < $cmonth) {
    $val = "true";
  } else if ($Eyear <= $cyear && $Emonth == $cmonth && $Eday <= $cday) {
    $val = "true";
  } else {
    $val = "false";
  }

  if ($val == "true") {
    $sql = "UPDATE users SET lbddate='$date', usertype='Recipient' WHERE username = '$username' ";
    if ($db->query($sql) === true) {
      $msg = "Date updated successfully !";
    } else {
      $msg = "Error updating the Request :" . $db->error;
    }
  } else {
    $msg = "Enter Valid Date !!";
  }
  echo "<script>alert( '$msg')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>My-Profile</title>
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

    table,
    th,
    td {
      padding: 2em;
      text-align: center;
      border: 3px solid black;
    }

    table {
      width: 100%;
      height: max-content;
    }

    img {
      width: 25%;
    }

    @media only screen and (max-width: 600px) {
      h2 {
        font-size: 2rem;
      }

      .a {
        left: 0px;
      }

      img {
        width: 50%;
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
        <a class="navbar-brand" href="index.php">Start</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="login-page.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li><a href="search-donor.php"><span class="glyphicon glyphicon-search"></span> Search Donor </a></li>
          <li><a href="donor_list.php"><span class="glyphicon glyphicon-list-alt"></span> Donor List </a></li>
          <li><a href="blood-stock.php"><span class="glyphicon glyphicon-tint"></span> Blood Stock </a></li>
          <li><a href="my-profile.php"><span class="glyphicon glyphicon-wrench"></span> My Profile </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div>
      <center><img class="img-responsive" src="img\logo.jpg" alt="RAKTIM"></center>
    </div>
    <hgroup>
      <h2 class="site-title" style="text-align:center; color: Red;">Welcome <?php echo $data['Name'] ?></h2>
      <hr>
    </hgroup>

    <main class="main-content  a">

      <div class="col-md-6 " style="left:1rem;font-size:2rem">
        <?php
        if (isset($_SESSION['message'])) {
          echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
          unset($_SESSION['message']);
        }
        ?>
        <!-- Displaying personal data type-->
        <div>
          <p>Name : <?php echo $data['Name'] ?></p>
          <p>City : <?php echo $data['City'] ?></p>
          <p>Gender : <?php echo $data['Gender'] ?></p>
          <p>Age : <?php echo $data['Age'] ?></p>
          <p>Blood Group : <?php echo $data['bgroup'] ?></p>
          <p>User Type : <?php echo $data['usertype'] ?></p>
          <p>UserName : <?php echo $data['username'] ?></p>
          <p>Last Blood Donated : <?php echo $data['lbddate'] ?></p>
          <p>Mobile No : <?php echo $data['mobile'] ?></p>
          <p>E-mail : <?php echo $data['Email'] ?></p>
          <br>
        </div>
        <!-- Editing User Type-->

      </div>

      <div class="col-md-6 " style="font-size:2rem;">
        <p>
          <h2 style="color: brown;">Step Ahead, Save Life, Donate Blood.</h2>
        </p>
        <br>

        <form method="POST">
          <div>
            <label for="usertype">User Type: </label>
            <select name="usertype" required>
              <option value="Donor">Donor</option>
              <option value="Recipient">Recipient</option>
            </select>
          </div>
          <input type="submit" name="update" class="btn btn-primary" value="Update">
        </form>

        <hr style="border:1px solid black;">
        <form METHOD="POST" action="my-profile.php">
          <div class="form-group" style="width:30rem;">
            <label>Enter your last date of blood Donation :</label>
            <input type="date" class="form-control" placeholder="" name="lastbddate" required>
          </div>
          <input type="submit" name="last-bd-update-btn" class="btn btn-primary" Value="Set Date">
          <p style="font-size:1rem;">If changes does not reflect then Please Refresh the page.</p>
        </form>

        <hr style="border:1px solid black;">
        <p>Do you wish to delete your Account?</p>
        <form METHOD="POST">
          <input type="submit" name="delete-btn" class="btn btn-primary" Value="Delete Account">
        </form>
        <hr style="border:1px solid black;">

        <?php
        if (isset($_POST['update'])) {
          echo "<script>alert( '$msg')</script>";
        }
        if (isset($_POST['delete-btn'])) {
          $sql = "DELETE FROM users WHERE username='$username'";
          if ($db->query($sql) === TRUE) {
            echo '<script>alert("Record deleted successfully")</script>';
          } else {
            echo "Error deleting record: " . $db->error;
          }
          echo '<script>window.location.href = "index.php";</script>';
        }

        ?>
      </div>
    </main>
  </div>
</body>

</html>