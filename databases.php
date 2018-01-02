<html lang="en" class="csstransforms csstransforms3d csstransitions">
<head>
<link rel="apple-touch-icon" sizes="76x76" href="https://upload.wikimedia.org/wikipedia/commons/d/d5/Wikipedia_edu_computer.png">
	<link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/d/d5/Wikipedia_edu_computer.png">

<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Grand+Hotel|Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<!-- CSS Files -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet"/>
	<link href="css/font-awesome.min.css" rel="stylesheet" />

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
</head>
<title>Databases</title>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">CPSC332 Final Project</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="index.php">HOME</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="professors.php">Professors</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<div id="blue" style="min-height:50px" style="text-align:left">
	<h3 style="">Databases Used</h3>
	</div>



<div class="wrapper">
<div class="container">

<?php

$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cs332s28";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Professor";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Professors:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>SSN</th><th>Name</th><th>Steet</th><th>City</th><th>State</th><th>Zip</th><th>Area Code</th><th>7 Digit</th><th>Sex</th><th>Title</th><th>Salary</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["ssn"] . "</td><td>". $row["name"] . "</td><td>". $row["street"] . "</td><td>". $row["city"] ."</td><td>". $row["state"] . "</td><td>". $row["zip"] . "</td><td>". $row["area_code"] . "</td><td>". $row["7_digit"] . "</td><td>". $row["sex"] . "</td><td>". $row["title"] . "</td><td>". $row["salary"] . "</td></tr>";
    }
  echo "</table>";
}

$sql = "SELECT * FROM Department";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Departments:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>Department Number</th><th>Name</th><th>Telepohone</th><th>Location</th><th>Chair SSN</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["dnum"] . "</td><td>". $row["name"] . "</td><td>". $row["telephone"] . "</td><td>". $row["location"] . "</td><td>". $row["chairssn"] . "</td></tr>";
    }
  echo "</table>";
}

$sql = "SELECT * FROM Course";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Courses:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>Course Number</th><th>Title</th><th>Textbook</th><th>Units</th><th>Prerequisite Course</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["cnum"] . "</td><td>". $row["title"] . "</td><td>". $row["textbook"] . "</td><td>". $row["units"] . "</td><td>". $row["prereqnum"] . "</td></tr>";
    }
  echo "</table>";
}

$sql = "SELECT * FROM Section";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Sections:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>Section Number</th><th>Course Number</th><th>Room</th><th>Meeting Days</th><th>Beginning time</th><th>End Time</th><th>Number of Seats</th><th>Professor</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["snum"] . "</td><td>". $row["cnum"] . "</td><td>". $row["room"] . "</td><td>". $row["meeting"] . "</td><td>". $row["beg_time"] . "</td><td>". $row["end_time"] . "</td><td>". $row["num_seats"] . "</td><td>". $row["pssn"] . "</td></tr>";
    }
  echo "</table>";
}

$sql = "SELECT * FROM Student";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Students:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>CWID</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Phone Number</th><th>Deparment Number</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["cwid"] . "</td><td>". $row["fname"] . "</td><td>". $row["lname"] . "</td><td>". $row["address"] . "</td><td>". $row["telephone"] . "</td><td>". $row["dnum"] . "</td></tr>";
    }
  echo "</table>";
}

$sql = "SELECT * FROM Record";
$result = mysqli_query($conn, $sql);
echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>All Records:</small></h2></div>";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  echo "<BR><BR><table class='table table-hover'>";
        echo "<thead><tr><th>CWID</th><th>Course Number</th><th>Section Number</th><th>Grade</th></tr></thead>";//header
    while($row = mysqli_fetch_assoc($result)) {
  echo "<tbody><tr><td>". $row["cwid"] . "</td><td>". $row["cnum"] . "</td><td>". $row["snum"] . "</td><td>". $row["grade"] . "</td></tr>";
    }
  echo "</table>";
}

mysqli_close($conn);

?>
</div>
</div>




</html>

<div id="footerwrap">
<div class="container">
<div class="col-xs-4">
<h4>Created By</h4>
<div class="hline-w"></div>
<p>Navie Vurdien, Natalie Ang, David Tran</p>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/retina-1.1.0.js"></script>
<script src="js/jquery.hoverdir.js"></script>
<script src="js/jquery.hoverex.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/custom.js"></script>
