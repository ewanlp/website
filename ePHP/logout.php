<?php
session_start();
require_once 'class.user.php';
$user = new USER();

//creates that user, and checks if they're not logged in, then if they are, they're signed out.
if(!$user->is_logged_in())
{
 $user->redirect('index.php');
}

if($user->is_logged_in()!="")
{
 $user->logout(); 
 $user->redirect('index.php');
}
?>
