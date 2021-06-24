<!DOCTYPE html>

<title>Home page</title>
<link rel="stylesheet" href="https://www01.wellsfargomedia.com/css/home/homepage_per.css" />

<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="mystyletest.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Footer -->
<?php include 'headerFooter.php';
echo "$header";?>
<!-- Footer ends -->

<!--Menubar -->

<nav>
  <ul class="nav">
	<li><a class="active" href="#home">Home</a>
	<li><a href="news.php">News</a></li>
	<li><a href="#contact">Contact</a></li>
	<li><a href="aboutUs.php">About Us</a></li>
  </ul>
</nav>

<!-- Menubar end -->

<!--Login start-->

<?php include('server.php') ?>

<div class="inner">
	<div id="signOn">

  <div class="header">
  	<b>Staff Login</b>
  </div>
	<form method="post" action="index.php">
  	  <?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Add yourself to test the app<a href="register.php" style="color: red;" >Sign up</a>
  	</p>
  </form>

	</div>
</div>
<!--End inner login-->           
           

           
     
            



<div class="c3">	
		<div class="c3Img">
          <img alt="" src="images/visit-tech.png" /> <!--Background image-->
        </div>
		
			<div class="inner">
				<div class="marqueeContent">
					<div class="marqueecontentinner marqueetheme11"> 
                        <p class="memberfdic"></p> <!--We can remove this line if there is nothing to write-->
                        <h2>Welcome To Georgia Tech Parking Maintenance Services</h2>
                        <span>Everyday is a brand new day</span>
	   	        		<a class="c7" role="button" href="http://news.kennesaw.edu/">News</a>
        			</div>
				</div>
			</div>
</div>
 
<!-- Footer -->
<?php include 'headerFooter.php';
echo "$footer";?>
<!-- Footer ends -->

</HTML>