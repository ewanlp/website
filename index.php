<?php
session_start();
require_once 'ePHP/class.user.php';
$user_login = new USER();

//if the user is already logged in, send them to the home page.
//should go to landing (index) where they're given option to sign in with buttons and such.
if($user_login->is_logged_in()!="")
{
 $user_login->redirect('pages/home.php');
}


/*****************    The skip button     *****************/

if(isset($_POST['btn-skip'])) {
	$user_login->redirect('pages/home.php');
}



/*****************    The log-in button     *****************/


if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 
 if($user_login->login($email,$upass))//tries to sign the user in, and send them to home page
 {
  $user_login->redirect('pages/home.php');
 }
}



/*****************    The sign-up button     *****************/


if (isset($_POST['btn-signUp'])) {
	
	$first = trim($_POST['txtFN']);
	$last = trim($_POST['txtLN']);
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $user_login->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
	if($stmt->rowCount() > 0) {
	  $msg = "
			<div class='alert alert-error'>
		<button class='close' data-dismiss='alert'>&times;</button>
		 <strong>Sorry !</strong> That email already exists - try another one, or use that email to sign in. If you forgot your password go ahead and reset it.
		 </div>
		 ";
	 }
	 else {
	  if($user_login->register($first,$last,$uname,$email,$upass,$code)) {   
	   $id = $user_login->lasdID();  
	   $key = base64_encode($id);
	   $id = $key;
	   
	   $message = "     
		  Hello $first,
		  <br /><br />
		  Welcome to the Piñon 1W Website!<br/>
		  To complete your registration  please click following link<br/>
		  <br /><br />
		  <a href='http://www.cs.colostate.edu/~ewanlp/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
		  <br /><br />
		  Thanks, Luke";
		  
	   $subject = "Sustainability Floor Wesbite Registration";
		  
	   $$user_login->send_mail($email,$message,$subject); 
	   $msg = "
		 <div class='alert alert-success'>
		  <button class='close' data-dismiss='alert'>&times;</button>
		  <strong>Success!</strong> $first, we've sent an email to $email.
						Please click on the confirmation link in the email to create your account. 
		   </div>
		 ";
	  }
	  else {
	   echo "sorry , Query could not execute...";
	  }
	 }
	
}


/*****************    The forgot pass button     *****************/


if(isset($_POST['btn-fpass'])) {
 $email = $_POST['txtemail'];
 
 $stmt = $user_login->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $id = base64_encode($row['userID']);
  $code = md5(uniqid(rand()));
  
  $stmt = $user_login->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
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
  $user_login->send_mail($email,$message,$subject);
  
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

<html>
<head>
	<title>Welcome Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/landing.css">
</head>

<body>
	
	<div class="container container-table">
	
		<div class="row vertical-center-row">
		  <div class="text-center col-md-4 col-md-offset-4">
		    <h1 class="h1-heading">Welcome</h1>
			

			<!-- Trigger the modal with a button -->
 			<a class="btn1 btn-block" href="#skModal" id="skBtn"><strong>Look Around</strong></a>
  			<a class="btn1 btn-block" href="#myModal" id="myBtn"><strong>Sign In</strong></a>
			
			
			
			<!-- CONTINUE AS GUEST MODAL -->
			
			
			<div class="modal fade" id="skModal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
				  
					<div class="modal-header" style="padding:35px 50px;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4><span class="glyphicon glyphicon-question-sign"></span> Continue as guest?</h4>
					</div>
					
					<div class="modal-body" style="padding:40px 50px;">
						<label for="psw">Are you sure you'd like to continue as a guest?</label>
						<a class="btn btn-success btn-block" href="pages/home.php"><span class="glyphicon glyphicon-ok"></span>  Yes!</a>
						<br>
						<a class="btn btn-info btn-block" data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-arrow-left"></span> No, I'd like to sign-in/sign-up</a>
					</div>
					<div class="modal-footer">
					  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				  </div>
				</div>
			  </div>
			
			
			
			
			
			<!-- If the user has signed up but is inactive, then this modal will pop up -->
			
			<?php 
			if(isset($_GET['inactive'])) {
			echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#inAct').modal('show');
					});
				</script>";
			?>

			<!-- Modal if the user has not registered yet, and has signed up. They'll recieve a new code -->
						
			  <div class="modal fade" id="inAct" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
				  
					<div class="modal-header" style="padding:35px 50px;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4><span class="glyphicon glyphicon-exclamation-sign"></span> Oops!</h4>
					</div>
					
					<div class="modal-body" style="padding:40px 50px;">
					  <form role="form" method="post">
						<div class="form-group">
						  <label for="psw">Looks like your account hasn't been activated. Check your email for a confirmation code, or re-enter your email below for a new code.</label>
						  <br>
						  <input type="text" class="form-control" id="usrname" placeholder="Enter email" name="txtemail">
						</div>
						  <button type="submit" class="btn btn-success btn-block" name="btn-fpass"><span class="glyphicon glyphicon-off" href="pS"></span> Send Email Again</button>
					  </form>
					  
					</div>
					<div class="modal-footer">
					  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				  </div>
				</div>
			  </div>
			
			<?php
			}
			?>
			
			
			
			<!--MODAL THAT POPS UP WHEN THE USER HAS SELECTED TO RE-SEND ACTIVATE CODE-->
			
			
			<div class="modal fade" id="pS">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="padding:35px 50px;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4><span class="glyphicon glyphicon-envelope"></span> Code Sent!</h4>
						</div>
						<div class="container"></div>
						<div class="modal-body" style="padding:40px 50px;">

						  <form role="form">

							<div class="form-group">
							  <label for="usrname"><span class="glyphicon glyphicon-user"></span> An email has been sent, follow the link there. </label>
							</div>
						  </form>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			

			<!-- Layer 1 -- Log In -->
			
			
		  <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header" style="padding:35px 50px;">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
				</div>
				<div class="modal-body" style="padding:40px 50px;">
				  <form role="form" method="POST">
					<div class="form-group">
					  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
					  <input type="text" class="form-control" id="usrname" placeholder="Enter email" name="txtemail">
					</div>
					<div class="form-group">
					  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
					  <input type="password" class="form-control" id="psw" placeholder="Enter password" name="txtpass">
					</div>
					  <button type="submit" class="btn btn-success btn-block" name="btn-login"><span class="glyphicon glyphicon-off"></span> Login</button>
				  </form>
				</div>
				<div class="modal-footer">
				  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				  <p>Not a member? <a data-toggle="modal" href="#su">Sign up!</a></p>
				  <p>Forgot <a data-toggle="modal" href="#fp">Password?</a></p>
				</div>
			  </div>
			</div>
		  </div>
		  
		  
		  

		 <!--SIGN-IN MODAL with fn ln user pass confirmpass-->
		 
		 
		 <div class="modal fade" id="su">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4><span class="glyphicon glyphicon-pencil"></span> Sign-Up</h4>
					</div>
					<div class="container"></div>
					<div class="modal-body" style="padding:40px 50px;">
					
					  <form role="form" method="POST">
						<div class="form-group">
						  <label for="firstName"><span class="glyphicon glyphicon-font"></span> First Name</label>
						  <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" name="txtFN">
						</div>

						<div class="form-group">
						  <label for="lastName"><span class="glyphicon glyphicon-font"></span> Last Name</label>
						  <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" name="txtLN">
						</div>

						<div class="form-group">
						  <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
						  <input type="text" class="form-control" id="email" placeholder="Enter Email" name="txtemail">
						</div>
						
						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
						  <input type="text" class="form-control" id="usrname" placeholder="Enter User Name" name="txtuname">
						</div>

						<div class="form-group">
						  <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
						  <input type="password" class="form-control" id="psw" placeholder="Enter password" name="txtpass">
						</div>
						
						<div class="form-group">
						  <label for="psw"><span class="glyphicon glyphicon-check"></span> Password</label>
						  <input type="password" class="form-control" id="psw" placeholder="Confirm Password">
						</div>
						  <button type="submit" class="btn btn-success btn-block" name="btn-signUp"><span class="glyphicon glyphicon-off"></span> Confim</button>
					  </form>
					</div>
					<div class="modal-footer">
					  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
		<!--USER FORGOT PASS-->
		
		
		<div class="modal fade" id="fp">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4><span class="glyphicon glyphicon-eye-open"></span> Reset Password</h4>
					</div>
					<div class="container"></div>
					<div class="modal-body" style="padding:40px 50px;">

					  <form role="form" method="POST">

						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-user"></span> Pelase enter your email so we can send you a new password.</label>
						  <input type="text" class="form-control" id="usrname" placeholder="Enter your email" name="txtemail">
						</div>
						  <!--CHECK IF USER EMAIL EXISTS IN DATABASE-->
						  <a class="btn btn-success btn-block" data-toggle="modal" href="#np"><span class="glyphicon glyphicon-off"></span> Enter</a>
					  </form>
					</div>
					<div class="modal-footer">
					  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
		
		<!---USER FORGOT PASS, RESET IT HERE...//BRINGS THEM TO MODAL TO SIGN IN AFTER--->
		
		
		<div class="modal fade" id="np">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px;">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4><span class="glyphicon glyphicon-ok"></span> Confirmation</h4>
					</div>
					<div class="container"></div>
					<div class="modal-body" style="padding:40px 50px;">

					  <form role="form" method="POST">

						<div class="form-group">
						  <label for="usrname"><span class="glyphicon glyphicon-pencil"></span> Pelase enter the code sent to your email</label>
						  <input type="text" class="form-control" id="usrname" placeholder="Enter code">
						</div>
						  
						  <!--ENTER BUTTON SHOULD RETURN USER BACK TO SIGN-IN MODAL-->
						  <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Enter</button>
					  </form>
					</div>
					<div class="modal-footer">
					  <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div>
		
		
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
    $("#skBtn").click(function(){
        $("#skModal").modal();
    });
});
</script>


<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>

<script>

$(document).ready(function () {

    $('#openBtn').click(function () {
        $('#myModal').modal({
            show: true
        })
    });

        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
});

</script>

</body>

</html>
