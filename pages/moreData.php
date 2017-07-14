<?php
session_start();
require_once '../ePHP/class.user.php';
$user_dataM = new USER();


/************** Query all that ish **************/

if (isset($_POST["num"])){
	$numQ = $_POST["num"];
	if (isset($_POST["race"])){
		$raceAlA = $_POST["race"];
		//$raceQ = explode(" ",$raceAlA);
		if (isset($_POST["sex"])){
			$sexQ = $_POST["sex"];
			if (isset($_POST["year"])){
				$yearT = array_values($_POST["year"]);
				echo"<br><br><br>";
				var_dump($yearT);
				//$yearQ = explode(" ", $yearT);
				if (isset($_POST["age"])){
					$pops = array_values($_POST["age"]);
					echo"<br><br><br>";
					var_dump($pops);
					if (isset($_POST["go"])){
						
						$query = "SELECT * FROM table4 WHERE ((origin=0 AND race=:raceP AND sex=:sexP";
						
						
						
						if (count($pops) > 0) {
							for ($x = 0; $x < count($pops); $x++) {
								$query .= " AND pop_" . $pops[$x] . "0=:pop_" . $pops[$x] . "";
							}
						}
						
						$query .= ") AND (year=:year0";
						
						if (count($yearT) > 1) {
							for ($x = 1; $x < count($yearT); $x++) {
								$query .= " OR year=:year" . $x . "";
							}
							$query .="))";
						} else {
							$query .="))";
						}
						
						
						
						$stmtM = $user_dataM->runQuery($query);
						
						$stmtM->bindparam(":raceP",$raceAlA);
						$stmtM->bindparam(":sexP",$sexQ);
						
						for ($x = 0; $x < count($pops); $x++) {
							$temp = "pops_" . $pops[$x] . "0";
							$stmtM->bindparam(":pop_". $x . "",$temp);
						}
						
						for($x = 0; $x < count($yearT); $x++) {
							$temp = $yearT[$x];
							$stmtM->bindparam(":year". $x . "",$temp);
						}
						echo "<br><br>";
						
						print_r(var_dump($stmtM));
						
						echo "<br><br>";
						//$stmtM->bindparam(":pop_".substr($ageT[$x],4,1)."0", $ageT[$x]);
						echo "<br>";
						var_dump($query);
						echo "<br>";
						var_dump(count($yearT));
						$stmtM->execute();
					}
				}else { echo '<br><br><br>Please set the age'; }
			}else { echo 'Please set the year'; }
		}else { echo 'Please set the sex'; }
	}else { echo 'Please set the race'; }
}else { echo '<br><br><br>Please set the number of elements'; }




/************** End of that query yo **************/

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
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
            <li><a href="data.php">Data</a></li>
            <li><a href="#"></a></li> 
          </ul>
        </li>
		<?php if(!$user_dataM->is_logged_in()) { ?>
		<li><a href="../index.php"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
		<?php }
		else { ?>
		<li><a href="../ePHP/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div id="intro" class="container text-center">
	<div class="row">
		<div class="col-md-12">
			<h1>Let's do some more interesting things</h1>
			<h3>Population projection, and analysis</h3>
		</div>
		<div class="col-md-12">
			<form class="form-inline" role="form" method="post">

			  <select class="selectpicker" id="inlineFormCustomSelect1" title="# of elements to display" name="num">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="max">All</option>
			  </select>
			  
			  <select class="selectpicker" id="inlineFormCustomSelect2" title="Race" name="race">
				<option value="0">All Races</option>
				<option value="1">White</option>
				<option value="2">Black</option>
				<option value="3">American Indian, Alaskan Native</option>
				<option value="4">Asian</option>
				<option value="5">Native Hawaiian, Pacific Islander</option>
			  </select>
			  
			  <select class="selectpicker" id="inlineFormCustomSelect3" title="Sex" name="sex">
				<option value="0">Both sexes</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
			  </select>
			
			<div class="button-group">
			
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Year<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#" class="small" data-value="2030" tabIndex="-1"><input type="checkbox" name="year[]" value="2030"/>2030</a></li>
					<li><a href="#" class="small" data-value="2031" tabIndex="-1"><input type="checkbox" name="year[]" value="2031"/>2031</a></li>
					<li><a href="#" class="small" data-value="2032" tabIndex="-1"><input type="checkbox" name="year[]" value="2032"/>2032</a></li>
					<li><a href="#" class="small" data-value="2033" tabIndex="-1"><input type="checkbox" name="year[]" value="2033"/>2033</a></li>
					<li><a href="#" class="small" data-value="2034" tabIndex="-1"><input type="checkbox" name="year[]" value="2034"/>2034</a></li>
					<li><a href="#" class="small" data-value="2035" tabIndex="-1"><input type="checkbox" name="year[]" value="2035"/>2035</a></li>
				</ul>
			</div>	  
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Age<span class="caret"></span></button>
				  <ul class="dropdown-menu">
					<li><input type="checkbox" name="age[]" value="1">10</input>
					<li><input type="checkbox" name="age[]" value="2">20</input>
					<li><input type="checkbox" name="age[]" value="3">30</input>
					<li><input type="checkbox" name="age[]" value="4">40</input>
					<li><input type="checkbox" name="age[]" value="5">50</input>
					<li><input type="checkbox" name="age[]" value="6">60</input>
					<li><input type="checkbox" name="age[]" value="7">70</input>
					<li><input type="checkbox" name="age[]" value="8">80</input>
					<li><input type="checkbox" name="age[]" value="9">90</input>
					<li><input type="checkbox" name="age[]" value="10">100</input>
				  </ul>
			
			  
			  <button type="submit" class="btn btn-primary" name="go">Go</button>
			</form>
		</div>
	</div>
</div>

<div class="row text-center">
	<div class="col-md-12">
		<table id="names" class="table table-condensed table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Race</th>
					<th>Sex</th>
					<th>Year</th>
					<th>Total Population of that Year</th>
					<th>Pop of age 10</th>
					<th>Pop of age 20</th>
					<th>Pop of age 30</th>
					<th>Pop of age 40</th>
					<th>Pop of age 50</th>
					<th>Pop of age 60</th>
					<th>Pop of age 70</th>
					<th>Pop of age 80</th>
					<th>Pop of age 90</th>
					<th>Pop of age 100</th>
					
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $stmtM->fetch(PDO::FETCH_ASSOC)){ ?>
					<tr>
						<td><?php echo htmlspecialchars($row['race']) ?></td>
						<td><?php echo htmlspecialchars($row['sex']) ?></td>
						<td><?php echo htmlspecialchars($row['year']) ?></td>
						<td><?php echo htmlspecialchars($row['total_pop']) ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>



<script>
	$(".dropdown-menu li a").click(function(){
		$(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
		$(this).parents(".dropdown").find('.btn').val($(this).data('value'));
	});
</script>



</body>
</html>