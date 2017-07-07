<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
 $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];
 
 $statusY = "Y";
 $statusN = "N";
 
 $stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
 $stmt->execute(array(":uID"=>$id,":code"=>$code));
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if($stmt->rowCount() > 0)
 {
  if($row['userStatus']==$statusN)
  {
   $stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
   $stmt->bindparam(":status",$statusY);
   $stmt->bindparam(":uID",$id);
   $stmt->execute(); 
   
   $msg = "
             <div class='alert alert-success'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>Wow !</strong>  Your Account is Now Activated, how about that : <a href='index.php'>Login here</a>
          </div>
          "; 
  }
  else
  {
   $msg = "
             <div class='alert alert-error'>
       <button class='close' data-dismiss='alert'>&times;</button>
       <strong>sorry !</strong>  Your Account is allready Activated, how convenient : <a href='index.php'>Login here</a>
          </div>
          ";
  }
 }
 else
 {
  $msg = "
         <div class='alert alert-error'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>sorry !</strong>  No Account Found, sign up instead : <a href='signup.php'>Signup here</a>
      </div>
      ";
 } 
}

?>
<!DOCTYPE html>
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
 			<a class="btn1 btn-block" href="#skModal" id="skBtn"><strong>Continue to the Sustainability Website!</strong></a>

		
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

