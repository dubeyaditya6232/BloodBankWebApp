<?php
session_start();
if (!$_SESSION) {
  echo '<script type="text/javascript">alert("You  are not logged IN");
 window.location.href = "index.php";
</script>';
}
include('connect.php');
$sql = "SELECT * FROM users  WHERE usertype= 'donor'";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Donor-list</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/996973c893.js"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;500;600;700;800&family=Roboto+Slab:wght@200;400;600;900&display=swap" rel="stylesheet" />
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

    .card {
      padding: 1em;
      background: white;
      box-shadow: 0 3px 10px blueviolet;
      margin-bottom: 1em;
    }

    @media only screen and (max-width: 600px) {
      h1 {
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
    <hgroup>
      <h1 class="site-title" style="text-align: center; color: Red;">Every blood donor is a life saver.</h1>
      <hr>
    </hgroup>
    <main class="main-content container-fluid">
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-3 col-sm-3">';
            echo '<div class="card">';
            echo '<div class="card-block">';
            echo '<h4 class="card-title">Name : ' . $row["Name"] . '</h4>';
            echo '<p>City : ' . $row["City"] . '</p>';
            echo '<p>Gender : ' . $row["Gender"] . '</p>';
            echo '<p>Age : ' . $row["Age"] . '</p>';
            echo '<p>Blood Group : ' . $row["bgroup"] . '</p>';
            echo '<p>Mobile No. : ' . $row["mobile"] . '</p>';
            echo '<p><a href="mailto:' . $row["Email"] . '">E-mail : ' . $row["Email"] . '</a></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<p class="text-center" style="color:red;">No User Found as Donor</p>';
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
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>


  <?php
  include("footer1.php");
  ?>
</body>

</html>