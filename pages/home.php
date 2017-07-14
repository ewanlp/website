<?php
session_start();
require_once '../ePHP/class.user.php';
$user_home = new USER();


/*****************     Check if user guest, or if they're not logged in     *****************/

if((!$user_home->is_logged_in()) && ($user_home->checkGuest()))
{
	$user_home->redirect('../index.php');
}


?>

<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Pinon 1 West</title>
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


<!-------------- The naviagtion bar that appears at the top of the screen - need to add a logo! ---------->


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
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#CSU">CSU</a></li>
        <li><a href="#TheFloor">The Floor</a></li>
        <li><a href="#LVLeaders">LV Leaders</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="data.php">Data</a></li>
            <li><a href="#">more Date</a></li>
            <li><a href="#">and even moreeee</a></li> 
          </ul>
        </li>
		
		
		<?php if(!$user_home->is_logged_in()) { ?>
		<li><a href="../index.php"><span class="glyphicon glyphicon-user"></span>Log in</a></li>
		<?php }
		else { ?>
		<li><a href="../ePHP/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
		<?php } ?>
		
        
      </ul>
    </div>
  </div>
</nav>



<!-------------- This is rotating photo slider, images go here ----------------->



<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="../img/pexels-photo.jpg" alt="Wind Turbine" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Wow, a Turbine</h3>
          <p>Dang, what an inspiring photo of a wind turbine. How 'bout that?</p>
        </div>      
      </div>

      <div class="item">
        <img src="../img/Luke1.jpg" alt="OSCAR" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Oscar</h3>
          <p>Wow, look! A picture of some members of the floor at Oscar, the industrial composter at CSU.</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="../img/solar-panel-array-power-plant-electricity-power-159160.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Solar Panels</h3>
          <p>Dnag, solar panel farms work even in the winter?</p>
        </div>
      </div>

     <div class="item">
        <img src="../img/WIN_20170408_18_41_26_Pro.jpg" alt="LV Gardens" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Gardens outside Pinon</h3>
          <p>A few members of the floor working on the gardens</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>



<!-------------- Container (The intro Section) Section describing The floor and has images below it ------------->



<div id="intro" class="container text-center">
  <h1>The Sustainability Floor of Pinon 1 West</h1>
  <p>The Sustainability Floor is part of the College of Natural Science Learning Community here in Laurel Village. We're a dedicated floor to sustainability. Residents who live on this floor have the opportunity to take on and dive-in to some different projects, programs, and initiatives throughout the school year - and beyond. The floor is only as old as Laurel Village (this will be its' 4th year) and has been growing ever since then. The floor features some unique aspects that make it truly one of a kind. Some of the photos give a little more perspective.<br><br>(For now, I'll leave it the green warrior and eco leader pics up, but the intention is to put pictures of some of the sustainable features we have there - such as the wood floors, the garden, and perhaps the lounge or something.)</p>
  <p></p>
  <br><br>
  <div class="row">
    <div class="col-sm-6">
      <p class="text-center" style="font-size: 30px;"><strong>Green Warrior</strong></p><br>
      <a href="#demo" data-toggle="collapse">
        <img src="../img/gW.png" class="img person" alt="Green Warrior" style="width:400px; height:350px">
      </a>
      <div id="demo" class="collapse">
        <p style="color: #1d7a0f;">Green Warrior is a campaign held by the Eco Leader program here on campus, in the Fall. The goal of the campaign is for <strong>you</strong> to consider your everyday habits and how they impact the environment</p>
        <p style="color: #1d7a0f;">You can find more info <a href="http://greenwarrior.colostate.edu/" target="_blank" style="text-decoration:none; color: #000">here</a>. The campign begins about mid-Spetember, so keep your eyes out!</p>
      </div>
    </div>
    <div class="col-sm-6">
      <p class="text-center" style="font-size: 30px;"><strong>Eco Leaders</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="../img/eco-leaders-text.png" class="img person" alt="Eco Leader" style="width:400px; height:350px">
      </a>
      <div id="demo2" class="collapse">
        <p style="color: #1d7a0f;">The Eco Leader program is an on-campus organization that raises awareness of sustainability in the residence halls. There is an Eco Leader living in every residence hall on campus (the Eco Leader of our hall, Saphyre, lives on our floor).</p>
        <p style="color: #1d7a0f;">They hold numerous events and campaigns that you can get involved in, just reach out to Saphyre or Luke!</p>
      </div>
    </div>
  </div>
</div>





<!------------- Container Paralax 1 Section) Upcoming events on the floor and in the community ----------->





<div id="" class="bg-1">
  <div class="container">
    <h3 class="h3Par1">Upcoming Events</h3>
    <p class="pPar1">Here's some of the upcoming events you can expect to see!<br>Be sure to check back here regularly</font></p>
    
    
    <div class="row text-center">
      <div class="col-sm-4">
        <div class="thumbnail">
          
          <p><strong>Move-In!</strong></p>
          <p>Wednesday, August 16th</p>
          <button class="btn" data-toggle="modal" data-target="#myModal1">More Info</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <p><strong>CNS Welcome Event</strong></p>
          <p>Wednesday, August 16th</p>
          <button class="btn" data-toggle="modal" data-target="#myModal2">More Info</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <!--- <img src="jpg" alt="" width="400" height="300"> -->
          <p><strong>Ram Welcome</strong></p>
          <p>Thursday - Sunday, August 20th</p>
          <button class="btn" data-toggle="modal" data-target="#myModal3">More Info</button>
        </div>
      </div>
    </div>
  </div>
  

  <!-------------- Start of the Modals ------------->
  
  
  
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">X</button>
          <h4><span class="glyphicon glyphicon-search"></span>  Move-In Info</h4>
        </div>
        <div class="modal-body">
	  <p class="mEvents"><span class="glyphicon glyphicon-exclamation-sign"></span> What</p>
	  <p class="mEvents">Move-in is exactly what it sounds like - you move into the your room!</p>
	  <p class="mEvents">Hannah and Luke will both be here to answer any questions you have, and to make sure you're getting settled just fine.</p>
	  <p class="mEvents">Try to get here early, it makes everything much easier!</p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-map-marker"></span> Where</p>
	  <p class="mEvents">Well, all over campus - but you'll be moving into Laurel Village, Pinon 1st Floor on the West side!</p>
	  <p class="mEvents"> The address is: 900W Plum St. 80521, Fort collins, CO </p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-time"></span> When</p>
	  <p class="mEvents">Starting time: 8am (get here early! avoid traffic!) Ending time: 3pm</p>
         </div>
              <button type="submit" class="btn btn-block" data-dismiss="modal">Got it!  
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">X</button>
          <h4><span class="glyphicon glyphicon-search"></span>  CNS Welcome Event</h4>
        </div>
        <div class="modal-body">
	  <p class="mEvents"><span class="glyphicon glyphicon-exclamation-sign"></span> What</p>
	  <p class="mEvents">The College of Natural Sciences Learning Community will be hosting some great events for you after you get moved in!</p>
	  <p class="mEvents">There will be demonstrations by the Little Shop of Physics, tye-dye, a photo booth, games, a movie on the Pavilion Slope, and so much more!</p>
	  <p class="mEvents">Take some time to relax, meet some new people, and have a good time. </p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-map-marker"></span> Where</p>
	  <p class="mEvents">The event will be held all over Laurel Village</p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-time"></span> When</p>
	  <p class="mEvents">The events begin around 4 o'clock - we'll probably grab some food as a floor first!</p>
         </div>
              <button type="submit" class="btn btn-block" data-dismiss="modal">Got it! 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
      </div>
    </div>

   <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">X</button>
          <h4><span class="glyphicon glyphicon-search"></span>  Ram Welcome</h4>
        </div>
        <div class="modal-body">
	  <p class="mEvents"><span class="glyphicon glyphicon-exclamation-sign"></span> What</p>
	  <p class="mEvents">Ram Welcome is a multi-day event that is designed to welcome you to CSU's campus!</p>
	  <p class="mEvents">We'll be spending this time as a floor, and you'll really get a chance to know those in your community.</p>
	  <p class="mEvents">There's far too many events to describe here so go check them out <a href="https://www.otp.colostate.edu/ramwelcome.aspx" target="_blank">here</a>.</p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-map-marker"></span> Where</p>
	  <p class="mEvents">Well, all over campus - but you'll be moving into Laurel Village, Pinon 1st Floor on the West side!</p>
	  <p class="mEvents"> The address is: 900W Plum St. 80521, Fort collins, CO </p>
          <br><br>
          <p class="mEvents"><span class="glyphicon glyphicon-time"></span> When</p>
	  <p class="mEvents">Starting time: 8am (get here early! avoid traffic!) Ending time: 3pm</p>
         </div>
              <button type="submit" class="btn btn-block" data-dismiss="modal">Got it! 
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>



<!------------ CSU sustainability section ---------------->



<div class="cotainer">
 <div class="row" style="height:20px;">
 </div>
 <div class="row" style="height: 540px;">
  <div class="col-md-8 text-center">
   <p id="CSU" style="color: #1d7a0f; font-size: 36px">Sustainabiliy at CSU</p>
   <p class="sustSection">Colorado State University is among the most highly regarded when it comes to sustainability, and we're very proud to say it!</p>
   <p class="sustSection">CSU is ranked #1 by <a href="https://stars.aashe.org/institutions/participants-and-reports/?sort=rating" target="_blank" style="text-decoration: none;">STARS</a>, a transparent organization that guages an institution's efforts towards Sustainability. CSU is the <strong> only </strong> University or instituation to be given a <span class="platColor">Platinum</span> rating, and we've received it two years in a row. The effort that CSU puts forth certainly shows! Take a look at <a href="https://green.colostate.edu/" target="_blank" style="text-decoration:none; color: #1d7a0f;">Green.Colostate.edu</a> for more info about CSU's dedication.</p>
   <p class="sustSection">Whether it be our solar farm, industrial composter (Oscar!), 42 departments conducting research related to sustainability, or our Platinum-rated bike-friendly campus, CSU has made a statement that sustainability is a top priority.</p>
   <br>
   <div class="row">
      <div class="col-md-6 col-md-offset-2 hidden-xs hidden-sm">
     <img src="../img/sustBanner.jpg">
    </div>
   </div>
  </div>
   <div class="col-md-4 hidden-xs hidden-sm">
     <img src="../img/sustainability.jpg" style="width: 90%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
   </div>
  </div>
  <div class="row" style="height:20px;">
  </div>
</div>

<div id="myModal" class="modalL">
  <span class="closeIt cursor" onclick="closeModal()">&times;</span>
  <div class="modal-contentT">

    <div class="mySlides">
      <div class="numbertext">1 / 2</div>
      <img src="../img/sustainability.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 2</div>
      <img src="../img/sustPoster.jpg" style="width:100%">
    </div>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="../img/sustainability.jpg" style="width:100%" onclick="currentSlide(1)" alt="Some initiatives CSU is taking to be more sustainable!">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/sustPoster.jpg" style="width:100%" onclick="currentSlide(2)" alt="Here's some more awesome info.">
    </div>
  </div>
</div>


<!---------------- Container (Parallax 2 Section) with the little icons ---------------->



<div id="TheFloor" class="bg-2">
 <div class="container text-center">
  <h3 class="h3Par2">So, what's the Sustainability Floor all about?</h3>
  <br><br>
  
  <!-- New row -->
  
  <div class="row">
  
   <!--- 1/3 --->
   <div class="col-md-4 col-xs-3 text-center" style="font-size:105px; cursor: pointer;">
    <a data-toggle="popoverLeaf" tigger="hover" placement="bottom" data-container="body" title="Not sure yet" data-content="Short and sweet info">
     <span style="color:white; cursor: pointer" class="glyphicon glyphicon-leaf"></span>
    </a>
   </div>
   
   <!--- 2/3 --->
   <div class="col-md-4 col-xs-3 col-xs-offset-6 col-ms-offset-0 col-md-offset-0 col-lg-offset-0 text-center" style="font-size: 105px;">
   <p class="text-center">
    <a data-toggle="popoverSearch" tigger="hover" placement="bottom" data-container="body" title="Education" data-content="Education and outreach are key in creating awareness about sustainability.">
     <span style="color:white; cursor: pointer;" class="glyphicon glyphicon-search"></span>
    </a>
   </p>
   </div>
   
   
   <!--- 3/3 mobile version --->
   <div class="row hidden-ms hidden-md hidden-lg col-xs-4 col-xs-offset-4 text-center" style="height:50px; font-size:105px;top:60px;bottom:30px;">
    <a data-toggle="popoverTrash" tigger="hover" placement="bottom" data-container="body" title="Waste" data-content="Whether it compost, batteries, or anything in between, there's a bin for everything!">
     <span style="color:white; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
    </a>
   </div>
   
   <!--- 3/3 large screen version--->
   <div class="hidden-xs col-md-3 col-md-offset-1 text-center" style="font-size: 105px;">
   <a data-toggle="popoverTrash" tigger="hover" placement="bottom" data-container="body" title="Waste" data-content="Whether it compost, batteries, or anything in between, there's a bin for everything!">
     <span style="color:white; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
    </a>
   </div>
   
  </div>

  
  <br><br><br><br><br>
  
  
  <!-- New row -->
  
  <div class="row" style="height: 200px;"> 
  
   <div class="col-md-6 col-xs-3 text-center" style="font-size: 105px;">
    <a data-toggle="popoverGrain" tigger="hover" placement="bottom" data-container="body" title="Gardening" data-content="The Sustainability Floor has its' own garden, used for education, and stress relief.">
     <span style="color:white; cursor: pointer;"  class="glyphicon glyphicon-grain"></span>
    </a>
   </div>
   

   <div class="col-md-6 col-xs-3 col-xs-offset-6 col-ms-offset-0 col-md-offset-0 col-lg-offset-0 text-center" style="font-size: 105px;">
    <a data-toggle="popoverArrow" tigger="hover" placement="bottom" data-container="body" title="Transportation?" data-content="Not sure if this belongs here, but here ya go">
     <span style="color:white; cursor: pointer;" class="glyphicon glyphicon-circle-arrow-right"></span>
    </a>
   </div>
   
  </div>
  
  <div class="row" style="height: 40px;">
  
	<div class="col-md-12">
		<p style="font-size: 24px; color: white;">More detailed info below.</p>
	</div>
  
  </div>
  
 </div>
</div>



<!-- Section for Lv Leaders and description of the floor! -->



<div id="LVLeaders" class="container">
  <h3 class="text-center" style="font-size: 30px;">About your floor and floor leadership</h3><br> 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#menu0">Luke</a></li>
    <li><a data-toggle="tab" href="#menu1">Hannah</a></li>
    <li><a data-toggle="tab" href="#menu2">Saphyre</a></li>
	<li><a data-toggle="tab" href="#menu3">Not too sure</a></li>
	<li><a data-toggle="tab" href="#menu4">Education</a></li>
	<li><a data-toggle="tab" href="#menu5">Waste</a></li>
	<li><a data-toggle="tab" href="#menu6">Gardening</a></li>
	<li><a data-toggle="tab" href="#menu7">Transportation</a></li>
  </ul>
  <div class="tab-content">
    <div id="menu0" class="tab-pane fade active">
      <h2>Luke Ewan, Resident Assistant</h2>
      <p>Here's where I talk about myself. Well, how does one really do that? I think it all starts with some solid deflection and I really enjoy that. Let me tell you something I've learned about deflecting from this podcast I heard the other night...</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h2>Hannah Mendoza, PAL and Hall Council President of LV</h2>
      <p>*Insert info here, Hannah* Eventually we can write what we enjoy doing in our spare time, who we are as people, and why we're in the positions that we're in (and why we enjoy them).</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h2>Saphyre Kelly, Eco Leader of Pinon Hall</h2>
      <p>*Insert info here, Saphyre* Eventually we can write what we enjoy doing in our spare time, who we are as people, and why we're in the positions that we're in (and why we enjoy them).</p>
    </div>
	<div id="menu3" class="tab-pane fade">
      <h2>Saphyre Kelly, Eco Leader of Pinon Hall</h2>
      <p>A brief description of whatever the tab says should go here. More detailed than the tooltip that popped up on the parralax section above, but not too detailed. Ya know. </p>
    </div>
	<div id="menu4" class="tab-pane fade">
      <h2>Education</h2>
      <p>Education is key in establishing awareness about sustainability. The Sustainability Floor takes pride in educating the surrounding community in topics ranging from
	  how to properly recycle here at CSU, to living sustainably at home over the summer. The floor has done many programs reaching out to the community... More to be written soon.</p>
    </div>
	<div id="menu5" class="tab-pane fade">
      <h2>Waste</h2>
      <p>A brief description of whatever the tab says should go here. More detailed than the tooltip that popped up on the parralax section above, but not too detailed. Ya know. </p>
    </div>
	<div id="menu6" class="tab-pane fade">
      <h2>The Garden</h2>
      <p>A brief description of whatever the tab says should go here. More detailed than the tooltip that popped up on the parralax section above, but not too detailed. Ya know. </p>
    </div>
	<div id="menu7" class="tab-pane fade">
      <h2>Transportation</h2>
      <p>A brief description of whatever the tab says should go here. More detailed than the tooltip that popped up on the parralax section above, but not too detailed. Ya know. </p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Bootstrap Theme Made By ya boi Luke Ewan (and the help ofsome wonderful people online who post useful info, all the credit goes to them).</p> 
</footer>

<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<script>
$(document).ready(function(){
    $('[data-toggle="popoverLeaf"]').popover();   
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popoverSearch"]').popover();   
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popoverTrash"]').popover();   
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popoverGrain"]').popover();   
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popoverArrow"]').popover();   
});
</script>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>
