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
<title>Professors</title>
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
            <li class="active"><a href="professors.php">Professors</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<div id="blue" style="min-height:50px" style="text-align:left">
	<h3 style="">Professors</h3>
	</div>




<div class="wrapper">
<div class="container">
<div class="col-xs-6 col-xs-offset-3">


<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="form-group">
<center><label for="InputName1" style="font-size:24px">SSN</label><BR>
<input type="text" class="form-control" placeholder="Social Security Number" name="sn" value="<?php echo $ssn;?>" required><span class="error" style="color:red">* <?php echo $ssnErr;?></span>
<BR><input type="submit" class="btn btn-theme" name="ssn_but" value="Submit"> </center>
</div>
</form>
<BR><BR>
<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<center><h1 style="font-size:24px">Course and Section Number</h1></center>
<div class="form-group" style="margin-left:100px">
<label for="InputName2">Course Number</label><BR>
<input type="text" class="form-control" placeholder="Course Number" name="course" value="<?php echo $cnum;?>" required><span class="error" style="color:red">* <?php echo $cnumErr;?></span>
</div>
<div class="form-group" style="margin-left:100px">
<label for="InputName3">Section Number</label><BR>
<input type="text" class="form-control" name="section" placeholder="Section Number" value="<?php echo $snum;?>" required><span class="error" style="color:red">* <?php echo $snumErr;?></span>
<BR>
</div>
<center><input type="submit" class="btn btn-theme" name="cosec_but" value="Submit"> </center>
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
//var_dump($_POST);

  if (isset($_POST["ssn_but"]) && empty($_POST["sn"])){
    echo "<font color=red>SSN is required</font>";
  }
  elseif(isset($_POST["ssn_but"]) && !empty($_POST["sn"])){
    $ssn = test_input($_POST["sn"]);
    if (!preg_match("/^[0-9 ]*$/",$ssn)) {
      echo "<font color=red>Only numbers allowed for SSN</font>";
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
//SELECT C.cnum, S.cnum, C.title, S.room, S.meeting, S.beg_time, S.end_time, S.pssn FROM Professor P, Section S, Course C WHERE P.ssn = $ssn AND S.pssn = P.ssn AND C.cnum = S.cnum
//;
	$sql = "SELECT C.cnum, S.cnum, C.title, S.room, S.meeting, S.beg_time, S.end_time, S.pssn FROM Professor P, Section S, Course C WHERE P.ssn = $ssn AND S.pssn = P.ssn AND C.cnum = S.cnum";
	$result = mysqli_query($conn, $sql);
	echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>Results for SSN ". $ssn .":</small></h2></div>";
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		echo "<BR><BR><table class='table table-hover'>";
      		echo "<thead><tr><th>Course Title</th><th>Classroom</th><th>Meeting Days</th><th>Start Time</th><th>End Time</th></tr></thead>";//header
	    while($row = mysqli_fetch_assoc($result)) {
		$btime = date('g:ia', strtotime($row["beg_time"]));
		$etime = date('g:ia', strtotime($row["end_time"]));
		echo "<tbody><tr><td>"  . $row["title"] . "</td><td>" . $row["room"] . "</td><td>" . $row["meeting"] . "</td><td>" . $btime . "</td><td>" . $etime . "</td></tr>";
	}
	echo "</table>";
	}
	else {
	    echo "<div class='col-xs-6'><p style='text-align:right'><BR><BR>No results found</p></div>";
	}
mysqli_close($conn);
    }

}

  if (isset($_POST["cosec_but"]) && (empty($_POST["course"]) || empty($_POST["section"]))){
    echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><font color=red>Course & Section Number are required</font>";
  }
  elseif(isset($_POST["cosec_but"]) && !empty($_POST["course"]) && !empty($_POST["section"])){
    $cnum = $_POST["course"];
    $snum = $_POST["section"];
    if (!preg_match("/^[0-9 ]*$/",$cnum) && !preg_match("/^[0-9 ]*$/",$snum)) {
      echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><font color=red>Only numbers allowed for Course & Section Number</font>";
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
	$sql = "SELECT R.grade, R.cnum, R.snum, S.cnum, S.snum, COUNT(R.grade) FROM Section S, Record R WHERE R.cnum = $cnum AND R.snum = $snum AND S.snum = R.snum AND S.cnum = R.cnum GROUP BY (R.grade)";
	$result = mysqli_query($conn, $sql);
	echo "<div class='col-xs-12' style='right:15px'><small><h2 style='text-align:left'><BR><BR>Results for Course ". $cnum ." - 0". $snum .":</small></h2></div>";
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
		echo "<BR><BR><table class='table table-hover'>";
      		echo "<thead><tr><th>Grade</th><th>Quantity</th></tr></thead>";//header
	    while($row = mysqli_fetch_assoc($result)) {
		echo "<tbody><tr><td>". $row["grade"] . "</td><td>". $row["COUNT(R.grade)"] . "</td></tr>";
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
