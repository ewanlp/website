<?php
session_start();
require_once '../ePHP/class.user.php';
$user_data = new USER();

/*****************     Check if user guest, or if they're not logged in     *****************/

if((!$user_data->is_logged_in()) && ($user_data->checkGuest()))
{
	$user_data->redirect('../index.php');
}

/*****************     Queries tbl_users and returns some info in data table     *****************/

$stmt= $user_data->runQuery("SELECT fName,lName,userName,userStatus FROM tbl_users ORDER BY lName");
$stmt->execute();

$wStmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather ORDER BY date");
$wStmt->execute();

$w2Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather LIMIT 0,20");
$w2Stmt->execute();


if (isset($_POST["month"])){
	$mon = $_POST["month"];
	switch($mon) {
		case "Jan":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-01-01' AND date <= '2010-01-31'");
			break;
		case "Feb":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-02-01' AND date <= '2010-02-28'");
			break;
		case "Mar":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-03-01' AND date <= '2010-03-31'");
			break;
		case "Apr":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-04-01' AND date <= '2010-04-30'");
			break;
		case "May":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-05-01' AND date <= '2010-05-31'");
			break;
		case "Jun":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-06-01' AND date <= '2010-06-30'");
			break;
		case "Jul":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-07-01' AND date <= '2010-07-31'");
			break;
		case "Aug":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-08-01' AND date <= '2010-08-31'");
			break;
		case "Sep":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-09-01' AND date <= '2010-09-30'");
			break;
		case "Oct":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-10-01' AND date <= '2010-10-31'");
			break;
		case "Nov":
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-11-01' AND date <= '2010-11-30'");
			break;
		default:
			$w3Stmt = $user_data->runQuery("SELECT stationName,evel,date,mtdPerc FROM weather WHERE date >= '2010-12-01' AND date <= '2010-012-31'");
	}
	$w3Stmt->execute();
}

if (isset($_POST['btn-signUp'])) {
	
	
	//all of these v's hold info that will be used below
	$first = trim($_POST['txtFN']);
	$last = trim($_POST['txtLN']);
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	//where.. means where userEmail (db phrase) use email_id as a place holder.
	$stmt4 = $user_data->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	//selects the userEmail (email_id is the placeholder) that is equal to email
	$stmt4->execute(array(":email_id"=>$email));
	//the actual execution
	$row = $stmt4->fetch(PDO::FETCH_ASSOC);
	$user_data->register($first,$last,$uname,$email,$upass,$code);
}

if (isset($_POST['btn-XsignUp'])) {
	
	
	//all of these v's hold info that will be used below
	$first = trim($_POST['txtFN']);
	$last = trim($_POST['txtLN']);
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$regExp = "[Xx]celenergy";
	
	if (preg_match('/xcelenergy/i',$email)) {
		$val = 'Y';
		
		$stmt5 = $user_data->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
		//selects the userEmail (email_id is the placeholder) that is equal to email
		$stmt5->execute(array(":email_id"=>$email));
		//the actual execution
		$row = $stmt5->fetch(PDO::FETCH_ASSOC);
		
		try {
					
			$password = md5($upass);
			$stmt5 = $user_data->runQuery("INSERT INTO xcelusers(fName,lName,userName,userEmail,userPass,tokenCode, val) 
															VALUES(:fN, :lN, :user_name, :user_mail, :user_pass, :active_code, :value)");
			$stmt5->bindparam(":fN",$first);
			$stmt5->bindparam(":lN",$last);
			$stmt5->bindparam(":user_name",$uname);
			$stmt5->bindparam(":user_mail",$email);
			$stmt5->bindparam(":user_pass",$password);
			$stmt5->bindparam(":active_code",$code);
			$stmt5->bindparam(":value",$val);
			//once execute is called, then everything gets bound to e/o uN to uN and so on
			$stmt5->execute();
			
		}catch(PDOException $ex){
			echo $ex->getMessage();
		}
	}
	
	else {
		$stmt5 = $user_data->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
		//selects the userEmail (email_id is the placeholder) that is equal to email
		$stmt5->execute(array(":email_id"=>$email));
		//the actual execution
		$row = $stmt5->fetch(PDO::FETCH_ASSOC);
		$user_data->register($first,$last,$uname,$email,$upass,$code);
	}
	
}

$stmtX = $user_data->runQuery("SELECT fName,lName,userName,userEmail FROM xcelusers ORDER BY lName");
$stmtX->execute();



?>
<html>
<head>
  <title>Your Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="../css/hStyle.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">HOME</a></li>
        <li><a href="#">CSU</a></li>
        <li><a href="#">The Floor</a></li>
        <li><a href="#">LV Leaders</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="home.php"></a>Home Page</li>
            <li><a href="moreData.php">More Data</a></li>
            <li><a href="#"></a></li> 
          </ul>
        </li>
		<?php if(!$user_data->is_logged_in()) { ?>
		<li><a href="../index.php"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
		<?php }
		else { ?>
		<li><a href="../ePHP/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Container (The intro Section) -->
<div id="intro" class="container text-center">
  <h1>Data</h1>
  <p>Here is some data that I've pulled from online, as well as from a local database that I have on my machine. 
     It will be pulled into a csv, and that read in by a script I wrote and then represented in these tables below.
     </p>
  <p></p>
  <div class="row">
	<div class="col-md-12">
		<p>First, we're going to display some data that we already have in our database.
		   This data is just some of the basic, public data of some of the users of the site.
		   (Authentication means, has the user authenticated themself after signing up - they
		   recieve an email and follow a link.)</p>
		<table id="names" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>User Name</th>
					<th>Authenticated?</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
					<tr>
						<td><?php echo htmlspecialchars($row['fName']) ?></td>
						<td><?php echo htmlspecialchars($row['lName']) ?></td>
						<td><?php echo htmlspecialchars($row['userName']) ?></td>
						<td><?php echo htmlspecialchars($row['userStatus']) ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		
		<br>
		
		<p>Alright, now we'll get some more interesting data and features. Below are some buttons to filter data however you'd like.
		   The data is from __ and was exported into a csv file, then read in and placed in data tables. 
		</p>
		<p></p>
		<div>
			<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#demo">Weather Data</button>
			<div id="demo" class="collapse">
				<table id="names" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Station Name</th>
							<th>Elevation</th>
							<th>Date</th>
							<th>MTD-Percip</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $wStmt->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<td> <?php echo htmlspecialchars($row['stationName']) ?></td>
								<td> <?php echo htmlspecialchars($row['evel']) ?></td>
								<td> <?php echo htmlspecialchars($row['date']) ?></td>
								<td> <?php echo htmlspecialchars($row['mtdPerc']) ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<p>Now, that seemed like quite a bit of data. We can make it a little bit easier to comprehend (only 20 pieces of data w/ condensed table).</p>
		<div>
			<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#demo2">More efficient display</button>
			<div id="demo2" class="collapse">
				<table id="names" class="table table-condensed table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Station Name</th>
							<th>Elevation</th>
							<th>Date</th>
							<th>MTD-Percip</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $w2Stmt->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<td> <?php echo htmlspecialchars($row['stationName']) ?></td>
								<td> <?php echo htmlspecialchars($row['evel']) ?></td>
								<td> <?php echo htmlspecialchars($row['date']) ?></td>
								<td> <?php echo htmlspecialchars($row['mtdPerc']) ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<br><br><br>
		<p>We can make this a little more dynamic - go ahead and choose what month of data you'd like to see.</p>
			<form role="form" method="post">
				<div class="form-group">
				  <label for="select_1">Select list:</label>
					<select class="form-control" id="select_1" name="month">
						<option value="Jan">Jan</option>
						<option value="Feb">Feb</option>
						<option value="Mar">Mar</option>
						<option value="Apr">Apr</option>
						<option value="May">May</option>
						<option value="Jun">Jun</option>
						<option value="Jul">Jul</option>
						<option value="Aug">Aug</option>
						<option value="Sep">Sep</option>
						<option value="Oct">Oct</option>
						<option value="Nov">Nov</option>
						<option value="Dec">Dec</option>
					</select>
				</div>
				<button type="submit" class="btn default btn-lg btn-block">Load Query</button>
			</form>
			<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#demo3">Toggle Show/Close</button>
			<div id="demo3" class="collapse">
			
				<table id="names" class="table table-condensed table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Station Name</th>
							<th>Elevation</th>
							<th>Date</th>
							<th>MTD-Percip</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = $w3Stmt->fetch(PDO::FETCH_ASSOC)){ ?>
							<tr>
								<td> <?php echo htmlspecialchars($row['stationName']) ?></td>
								<td> <?php echo htmlspecialchars($row['evel']) ?></td>
								<td> <?php echo htmlspecialchars($row['date']) ?></td>
								<td> <?php echo htmlspecialchars($row['mtdPerc']) ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<br><br><br>
		<p>
		Yes, that was pretty clunky and didn't function the best, but the point was to show some dynamic queries!
		Let's try something a little more advanced - let's create a datatable on the fly and populate it.<br>
		Go ahead and add a user - if the email is an xcel email, a different table will be updated:
		</p>
	</div>
  </div>
	<div class="row collapse" id="demo4">
		<form role="form" method="post">
			<div class="form-group">
			  <label for="firstName"></label>
			  <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="txtFN">
			</div>

			<div class="form-group">
			  <label for="lastName"></label>
			  <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" name="txtLN">
			</div>

			<div class="form-group">
			  <label for="email"></label>
			  <input type="text" class="form-control" id="email" placeholder="Enter Email" name="txtemail">
			</div>
			
			<div class="form-group">
			  <label for="usrname"></label>
			  <input type="text" class="form-control" id="usrname" placeholder="Enter User Name" name="txtuname">
			</div>

			<div class="form-group">
			  <label for="psw"></label>
			  <input type="password" class="form-control" id="psw" placeholder="Enter password" name="txtpass">
			</div>
			
			<div class="form-group">
			  <label for="psw"></label>
			  <input type="password" class="form-control" id="psw" placeholder="Confirm Password">
			</div>
			  <button type="submit" class="btn default btn-lg btn-block" name="btn-signUp">Confim</button>
		</form>
	</div>
	
	<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#demo4">Open/Close Signup Form</button>
	<br>
	<p>Notice how the table at the top of page refreshed when a user was successfully added?
		Now, we do some even better, more dynamic things. Let's make a whole new row (or table)
		somewhere else, if that user has an email ending in xcelenergy.com theyll be added to it.
	</p>
	
	<div class="row collapse" id="demo5">
		<form role="form" method="post">
			<div class="form-group">
			  <label for="firstName"></label>
			  <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="txtFN">
			</div>

			<div class="form-group">
			  <label for="lastName"></label>
			  <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" name="txtLN">
			</div>

			<div class="form-group">
			  <label for="email"></label>
			  <input type="text" class="form-control" id="email" placeholder="Enter Email" name="txtemail">
			</div>
			
			<div class="form-group">
			  <label for="usrname"></label>
			  <input type="text" class="form-control" id="usrname" placeholder="Enter User Name" name="txtuname">
			</div>

			<div class="form-group">
			  <label for="psw"></label>
			  <input type="password" class="form-control" id="psw" placeholder="Enter password" name="txtpass">
			</div>
			
			<div class="form-group">
			  <label for="psw"></label>
			  <input type="password" class="form-control" id="psw" placeholder="Confirm Password">
			</div>
			  <button type="submit" class="btn default btn-lg btn-block" name="btn-XsignUp">Confim</button>
		</form>
	</div>
	
	<button type="button" class="btn btn-default btn-lg btn-block" data-toggle="collapse" data-target="#demo5">Open/Close Xcel Signup</button>
	
	<p>
	<br>
		Here's the table for users with an xcelenergy email. It also gets dynamically updated with each new additional user.
	<br>
	</p>
	
	<table id="names" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>User Name</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $stmtX->fetch(PDO::FETCH_ASSOC)){ ?>
					<tr>
						<td><?php echo htmlspecialchars($row['fName']) ?></td>
						<td><?php echo htmlspecialchars($row['lName']) ?></td>
						<td><?php echo htmlspecialchars($row['userName']) ?></td>
						<td><?php echo htmlspecialchars($row['userEmail']) ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	
	
	
	
	
</div>

<script>
	$(document).ready(function(){

		/* Button which shows and hides div with a id of "post-details" */
		$( ".toggle-visibility" ).click(function() {
		  
		  var target_selector = $(this).attr('data-target');
		  var $target = $( target_selector );
		  
		  if ($target.is(':hidden'))
		  {
			$target.show( "slow" );
		  }
		  else
		  {
			$target.hide( "slow" );
		  }
		  
		  console.log($target.is(':visible'));

	  
	});
</script>

</body>
</html>
