<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
 $user_login->redirect('../Pages/home.php');
}

if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtupass']);
 
 if($user_login->login($email,$upass))
 {
  $user_login->redirect('../Pages/home.php');
 }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Full Screen Landing Page</title>
	<link rel="stylesheet" type="text/css" href="../landing.css">
</head>

<body>
	<?php
	//if inactive is set, from the user class, userStatus!=Y
	if (isset($_GET['inactive'])) {
	
	

	}




	?>
	<section class="intro">
	
		<div class="inner">
			<div class="content">
				<h1>Welcome</h1>
				<a class="btn" href="pages/home.html">Get Started</a>
			</div>
		</div>
	</section>
</body>

</html>