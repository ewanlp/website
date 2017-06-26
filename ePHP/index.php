<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

//if the user is already logged in, send them to the home page.
//should go to landing (index) where they're given option to sign in with buttons and such.
if($user_login->is_logged_in()!="")
{
 $user_login->redirect('../pages/home.php');
}

//if button login aleady has info, save info in v's
if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);//trim removes any white space
 $upass = trim($_POST['txtupass']);
 
 if($user_login->login($email,$upass))//tries to sign the user in, and send them to home page
 {
  $user_login->redirect('../pages/home.php');
 }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login | Pinon 1W</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
  <?php 
  if(isset($_GET['inactive']))//if the user was labeled as inactive from user class...
  {
   ?>
            <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>Sorry!</strong> This account is not activated Go to your Inbox and Activate it. 
   </div>
            <?php
  }
  ?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))//if there was an error with logging in...
  {
   ?>
            <div class='alert alert-success'>
    <button class='close' data-dismiss='alert'>&times;</button>
    <strong>Wrong Details!</strong> 
   </div>
            <?php
  }
  ?>
        <h2 class="form-signin-heading">Sign In.</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
      <hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
        <a href="signup.php" style="float:right;" class="btn btn-large">Sign Up</a><hr />
        <a href="fpass.php">Lost your Password ? </a>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
