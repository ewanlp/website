<?php

session_start();
require_once 'class.user.php';
$user = new USER();

if(isset($_GET[)

$stmt = 'SELECT * FROM 'users'';
$stmt->execute();

?>


<html>
<head>
	<title>Board Game Stats</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
</meta>
<body>

<button data-target="#test" class="btn btn-primary btn-lg btn-block" data-toggle="collapse" style="text-decoration:none;">Toggle Bar</button>

<div class="containter fluid">
	<div id="test" class="collapse">
		<div class="table-responsive">
			<table class="table table-ztriped table-hover ">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
					</tr>
				</thead>
				<tbody>
				<?php
				while ($row = mysqli_fetch_array($nameQuesry)) {
					
					echo'<tr>
						<td>'.$row['FirstName'].'</td>
						<td>'.$row['FirstName'].'</td>
						<td>'.$row['FirstName'].'</td>
						<td>'.$row['FirstName'].'</td>
					</tr>';
					
				}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>
