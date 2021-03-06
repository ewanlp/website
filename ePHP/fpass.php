<?php
session_start();
require_once 'class.user.php';
//requires a the user class, then makes a new user. Starts the session b/c we're actually doing something here!
$user = new USER();

//if the user is already logged in, they can't have forgotten their password! (They can reset it in another page)
if($user->is_logged_in()!="")
{
 $user->redirect('../Pages/home.html');
}

//gets user info thru post, if btn-submit is set, then it takes the data from that form
//and checks if the email exists. Runs a query and generates a random code to send to the user.
if(isset($_POST['btn-submit']))
{
 $email = $_POST['txtemail'];
 
 $stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $id = base64_encode($row['userID']);
  $code = md5(uniqid(rand()));
  
  $stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
  $stmt->execute(array(":token"=>$code,"email"=>$email));
  
  $message= "
       Hello , $email
       <br /><br />
       I got requested to reset your password. If you'd like to reset the password, click on the link below. Otherwise, go ahead and ignore this email or let Luke know that you did request to reset your password.
       <br /><br />
       Click Following Link To Reset Your Password 
       <br /><br />
       <a href='http://www.cs.colostate.edu/~ewanlp/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
       <br /><br />
       Thank you :)
       ";
  $subject = "Password Reset, Sustainability Wesbsite";
  
  //Sends the email to the user with the message and subject.
  //sends them to resetPass site with the id and code set (they were already generated)
  $user->send_mail($email,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     I've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
      </div>";
 }
 else
 {
  $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong>  The email provided was not found not found. Please try again. 
       </div>";
 }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Forgot Password</h2><hr />
        
         <?php
   if(isset($msg))
   {
    echo $msg;
   }
   else
   {
    ?>
               <div class='alert alert-info'>
    Please enter your email address. You will receive a link to create a new password via email!
    </div>  
                <?php
   }
   ?>
        
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
      <hr />
        <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
