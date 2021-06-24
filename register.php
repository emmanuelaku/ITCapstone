<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home page</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www01.wellsfargomedia.com/css/home/homepage_per.css" />
<link rel="stylesheet" type="text/css" href="mystyletest.css">	


<header>
  <a href="http://ccse.kennesaw.edu/it"><img src="images/gt_logo.png" alt="ksu logo" title="Click to open KSU site on a different tab"><br style="width:100px;height:800px:"></a>
</header>

<!--Menubar -->

<nav>
  <ul class="nav">
  <li><a class="active" href="#home">Home</a>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  
    
    
  </ul>
</nav>

<!-- Menubar end -->

<!-- Watermark -->

<!--Watermark ends-->


<!--Sample area start-->

<?php include('server.php') ?>

<div class="inner">
	<div id="signOn">

  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php" autocomplete="off">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php" style="color: red;">Sign in</a>
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
<!--Sample area end-->

<!-- Footer -->

  <footer>

<h5>UNIVERSITY CONTACT INFO</h5>

<div class="row">
  <div class="column">
    	
	<ol><b>Kennesaw Campus</b>					
		<br>1000 Chastain Road							
			Kennesaw, GA 30144								
			Phone: 470-578-6000	</a>
		
  </div>
  
  <div class="column">
    <a p> </p></a>
  </div>
  
  <div class="column">
  
	<ol> <b>Marietta Campus</b>
	<br>100 South Marietta Pkwy
		Marietta, GA 30060<br>
		Phone: 470-578-6000</a>
	
  </div>
</div>
<p> 2018 Kennesaw State University. This is a class project.</p>
</footer>


<!-- Footer ends -->

</HTML>




<!-- Replaced with the above code

<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
  <title>Registration system PHP and MySQL</title>
 <link rel="stylesheet" type="text/css" href="mystyletest.css">
</head>

<div class="regheader">
<body>

  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>
</body>

</div>

</html>

-->