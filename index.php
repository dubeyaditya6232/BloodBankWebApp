<?php
session_start();

include('connect.php');

//$reqbg=$_POST["bgroup"];
//$username= $_SESSION["username"];
$mydate = getdate(date("U"));
$cmonth = $mydate['mon'];
$cday = $mydate['mday'];
$cyear = $mydate['year'];
$sql2 = "SELECT date FROM users WHERE Request='1'";
$result1 = $db->query($sql2);
if ($result1->num_rows > 0) {
  while ($row1 = $result1->fetch_assoc()) {
    //echo $row1["date"];
    $date1 = date_create();
    $date1 = $row1["date"];
    $dateElements = explode('-', $date1);
    $Emonth = $dateElements[1];
    $Eday = $dateElements[2];
    $Eyear = $dateElements[0];
    //echo $Eday;
    //echo date("Y-m-d",strtotime($date1));

    if ($Eyear <= $cyear) {
      if ($Emonth <= $cmonth) {
        if ($Eday < $cday) {
          $query1 = "UPDATE users
              SET Request='0',
                  reqbg='NULL',
                  date='0000-00-00'
              WHERE date =' " . $row1["date"] . " '";
          if ($db->query($query1) === true) {
            //echo " Updated Active Users";
          }
        }
      }
    }
  }
}





$sql = "SELECT * FROM users  WHERE Request='1'";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>BloodBank</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    #error_msg {
      width: 50%;
      margin: 5px auto;
      height: 30px;
      border: 1px solid #FF0000;
      background: red;
      color: #FF0000;
      text-align: center;
      padding: 1em;
    }

    body {
      background-color: #e6ffff;
    }

    .card {
      padding: 1em;
      background: white;
      box-shadow: 0 3px 10px blueviolet;
      margin-bottom: 1em;
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

    #logo img {
      height: 50px;

    }

    @media only screen and (max-width: 450px) {
      h1 {
        font-size: 2rem;
      }

      h2 {
        font-size: 2rem;
      }

      .sticky {
        font-size: 12px;
      }

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
  <div id="logo">
    <center><img class="img-responsive" src="img/logo.jpg" alt="RAKTIM"></center>
  </div>
  <div class="container-fluid">
    <hr>
    <main class="main-content container-fluid">
      <p>
        <h1 class="text-center" style="color: #B22222 ;">Active Requests Available</h1>
      </p>

      <br>
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-3 col-sm-3">';
            echo '<div class="card">';
            echo '<div class="card-block">';
            echo '<h4 class="card-title">Name : ' . $row["Name"] . '</h4>';
            echo '<p>City : ' . $row["City"] . '</p>';
            // echo '<p>Gender : '.$row["Gender"].'</p>';
            // echo '<p>Age : '.$row["Age"].'</p>';
            echo '<p style="color:Red;">Blood Group Required: ' . $row["reqbg"] . '</p>';
            echo '<p style="color:Red;">Date of Requirement: ' . $row["date"] . '</p>';
            echo '<p>Mobile No. : ' . $row["mobile"] . '</p>';
            echo '<p>E-mail : <a href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<p> <h2 class="text-center" style="color:Red;text-align:centre;">No User Has Requested for Blood</h2></p>';
        }
        ?>
        <?php
        if (isset($_SESSION['message'])) {
          echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
          unset($_SESSION['message']);
        }
        ?>
      </div>
    </main>
    <br>

    <br>
    <br>
    <?php
    include("footer.php");
    ?>
</body>

</html>