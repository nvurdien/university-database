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
<title>Students</title>
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
            <li class="active"><a href="students.php">Students</a></li>
            <li><a href="professors.php">Professors</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<div id="blue" style="min-height:50px" style="text-align:left">
	<h3 style="">Students</h3>
	</div>


<div class="wrapper">
<div class="container">
<div class="col-xs-6 col-xs-offset-3">

<form action="students.php" role="form" method="POST">
<div class="form-group">
<center><label for="InputName1" style="font-size:24px">CWID</label><BR>
<input type="text" class="form-control" name="id" placeholder="Campus-Wide ID" value="<?php echo $cwid;?>"><span class="error" style="color:red">*</span>
<BR><input type="submit" class="btn btn-theme" name="cwid_but" value="Submit"> </center>
</div>
</form>
<BR><BR>
<form action="students.php" role="form" method="POST">
<div class="form-group">
<center><label for="InputName2" style="font-size:24px">Course Number</label><BR>
<center><input type="text" class="form-control" name="course" placeholder="Course Number"  value="<?php echo $cnum;?>"><span class="error" style="color:red">*</span>
<BR><input type="submit" class="btn btn-theme" name="course_but" value="Submit"> </center>
</div>
</form>

</div>
<?php
// define variables and set to empty values

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}



  if (isset($_POST["cwid_but"]) && empty($_POST["id"])){
    echo "<font color=red>CWID is required</font>";
  }
  elseif(isset($_POST["cwid_but"]) && !empty($_POST["id"])){
    $cwid = test_input($_POST["id"]);
    if (!preg_match("/^[0-9 ]*$/",$cwid)) {
      echo "<font color=red>Only numbers allowed for CWID</font>";
    }
    else{
	$servername = "ecsmysql";
	$username = "cs332s28";
	$password = "kohxeobe";
	$dbname = "cs332s28";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT  R.cwid, R.cnum, C.cnum, R.grade, C.title FROM Record R, Course C WHERE R.cwid = $cwid AND R.cnum = C.cnum";
	$result = mysqli_query($conn, $sql);
		echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>Results for CWID ". $cwid .":</small></h2></div>";
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		echo "<BR><BR><table class='table table-hover'>";
      		echo "<thead><tr><th>Course Title</th><th>Grade</th></tr></thead>";//header
	    while($row = mysqli_fetch_assoc($result)) {
		echo "<tbody><tr><td>". $row["title"] . "</td><td>". $row["grade"] . "</td></tr>";
		}
		echo "</table>";
	}
	else {
	    echo "<div class='col-xs-6'><p style='text-align:right'><BR><BR>No results found</p></div>";
	}
mysqli_close($conn);
    }
}

  if (isset($_POST["course_but"]) && empty($_POST["course"])){
    echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><font color=red>Course Number is required</font>";
  }
  elseif(isset($_POST["course_but"]) && !empty($_POST["course"])){
    $cnum = test_input($_POST["course"]);
    if (!preg_match("/^[0-9 ]*$/",$cnum)) {
      echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><font color=red>Only numbers allowed for Course Number</font>";
    }
    else{
	$servername = "ecsmysql";
	$username = "cs332s28";
	$password = "kohxeobe";
	$dbname = "cs332s28";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT C.cnum, S.cnum, S.snum, C.title, S.room, S.meeting, S.beg_time, S.end_time, R.cnum, R.snum, COUNT(R.snum) FROM Course C, Section S, Record R WHERE C.cnum = $cnum AND C.cnum = S.cnum AND R.cnum=S.cnum AND R.snum = S.snum GROUP BY (R.snum)";
	$result = mysqli_query($conn, $sql);
	echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>Results for Course ". $cnum .":</small></h2></div>";
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		echo "<BR><BR><table class='table table-hover'>";
      		echo "<thead><tr><th>Section</th><th>Classroom</th><th>Meeting Days</th><th>Beginning Time</th><th>End Time</th><th>Number Enrolled</th></tr></thead>";//header
	    while($row = mysqli_fetch_assoc($result)) {
		$btime = date('g:ia', strtotime($row["beg_time"]));
		$etime = date('g:ia', strtotime($row["end_time"]));
	        echo "<tbody><tr><td>". $row["snum"] ."</td><td>". $row["room"] . "</td><td>". $row["meeting"] . "</td><td>". $btime . "</td><td>". $etime . "</td><td>". $row["COUNT(R.snum)"] . "</td></tr>";
		}
		echo "</table>";
	}
	else {
	    echo "<div class='col-xs-6'><p style='text-align:right'><BR><BR>No results found</p></div>";
	}
mysqli_close($conn);
    }
}

?>
</div>

</div>




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
