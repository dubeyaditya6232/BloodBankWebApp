<?php
session_start();
include('connect.php');
if (!$_SESSION) {
  echo '<script type="text/javascript">alert("You  are not logged IN");
        window.location.href = "index.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Blood Stock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {
      background-color: #cceabb;
      font-family: "Lato", sans-serif;
    }

    .card {
      padding: 1em;
      background: #ff9999;
      border: 1px solid black;
      box-shadow: 0 3px 10px black;
      margin-bottom: 1em;
      min-height: 20rem;
    }

    body {
      background-color: #cceabb;
    }

    @media only screen and (max-width: 600px) {
      h1 {
        font-size: 2rem;
      }

      .card {
        min-height: fit-content;
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
          <li><a href="my-profile.php"><span class="glyphicon glyphicon-wrench"></span> My Profile </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <main class="main-content">
      <h2 class="text-center bg-danger">Stock Availability</h2>
      <form METHOD="GET">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="state">State: </label>
              <input type="text" class="form-control" placeholder="Enter state" name="state" required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="city">City: </label>
              <input type="text" class="form-control" placeholder="Enter City" name="city" required>
            </div>
          </div>
          <div class="col-md-3">
            <label for="bgroup">Blood Group: </label>
            <div class="form-group">
              <select name="bgroup" class="form-control" required>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <br>
            <input type="submit" name="search-stock-btn" class="btn btn-primary" Value="Search">
          </div>
        </div>
      </form>
  </div>
  <br>
  <br>
  <?php
  error_reporting(0);
  $state = $_GET['state'];
  $city = $_GET['city'];
  $bgroup = $_GET['bgroup'];
  /*echo $state;
    echo $city;
    echo $bgroup;*/
  if (isset($_GET['search-stock-btn'])) {
    $query1 = "SELECT * FROM bloodstock WHERE State='$state' AND City='$city' AND bgroup='$bgroup' ";
    $result1 = $db->query($query1);
    if ($result1) {
    } //echo "Selection successful";
    else
      echo "error   ->" . $db->error;
  }
  ?>
  <h2 style="color:red;">Search Results :</h2>
  <br>
  <?php
  if (isset($_GET['search-stock-btn'])) {
    if ($result1->num_rows <= 0)
      echo '<p class="text-center"style="color:red;">No Blood Stock information Available</p>';
    else {
      echo '<div class="container-fluid">'; //container opened
      echo '<div class="row">'; //Row opened
      while ($row = $result1->fetch_assoc()) {
        echo '<div class="col-lg-3 col-sm-3">';
        echo '<div class="card">';
        echo '<div class="card-block">';
        echo '<h4 class="card-title " style="color:green;">Status : ' . $row['status'] . '</h4>';
        echo '<p style="left:0;color:black;">Address :</p>';
        echo '<p>' . $row['address'] . '</p>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>'; //Row closed
      echo '</div>'; //container closed
    }
  }
  ?>
  </main>
  </div>
</body>

</html>