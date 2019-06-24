<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php'; 
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>register</title>
<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
</head>
<body>

	<?php 
	if(isset($_POST['reg_clicked'])){
		echo '
		<script>
		$(document).ready(function(){
			$("#first").hide();
			$("#second").show();
		})

		</script>
		';
	}


	?>

<div class="wrapper">

    <div class="login_box">
    	<div class="login_header">
			<h1>kiitbook</h1>
			Login or Signup below!
		</div>	
		<div id="first">
		<form action="register.php" method="POST">
		<input type="email" name="log_email" placeholder="Email Address" value="<?php 
		if(isset($_SESSION['log_email']))
			echo $_SESSION['log_email'] ;
			?>" required><br>
		<input type="password" name="log_password" placeholder="Password"><br>
		<?php  if(in_array("Email or password was incorrect<br>",$error_array)) echo "Email or password was incorrect<br>"?>
		
        <button name="login_button" value="login">Login</button><br>
        <a href="#" id="signup" class="signup">Need an account register here!</a>

		</form>
		</div>


        <div id="second">

		<form action="register.php" method="POST">
		<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
		if(isset($_SESSION['reg_fname']))
			echo $_SESSION['reg_fname'] ;
			?>"  required>
		<br>
		<?php  if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>


		<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
		if(isset($_SESSION['reg_lname']))
			echo $_SESSION['reg_lname'] ;
			?>" required>
		<br>
		<?php  if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
		<br>
		Male<input type="radio" name="gender" value="male" checked>
		Female<input type="radio" name="gender" value="female" >
		<br>

		Year<br><select name="year">  <option  value="1st">1st</option> <option value="2nd">2nd</option> <option value="3rd">3rd</option> <option value="4th">4th</option> </select><br>
		Branch<br><select name="branch"> <option value="CSE">CSE</option> <option value="IT">IT</option> <option value="CSSE">CSSE</option> <option value="CSCE">CSCE</option> </select><br>

		<input type="email" name="reg_email" placeholder="E-mail" value="<?php 
		if(isset($_SESSION['reg_email']))
			echo $_SESSION['reg_email'] ;
			?>" required>
		<br>
		<input type="email" name="reg_conemail" placeholder="Confirm E-mail" value="<?php 
		if(isset($_SESSION['reg_conemail']))
			echo $_SESSION['reg_conemail'] ;
			?>" required>
		<br>
		<?php  if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
		  if(in_array("Invalid Email<br>", $error_array)) echo "Invalid Email<br>";
		  if(in_array("Emails dont match<br>", $error_array)) echo "Emails dont match<br>";?>



		<input type="password" name="reg_pwd" placeholder="Password" required>
		<br>
		<input type="password" name="reg_conpwd" placeholder="Confirm Password" required>
		<br>
		<?php  if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
		  if(in_array("Your password can contain english characters and numbers only<br>", $error_array)) echo "Your password can contain english characters and numbers only<br>";
		  if(in_array("Your password mus be between 5 and 30 characters<br>", $error_array)) echo "Your password mus be between 5 and 30 characters<br>";?>

		<button name="reg_clicked" type="submit" value="Register">Sign Up</button>
		<?php  if(in_array( "<span style='color:#148C00;'>You are all set! Go ahead and login!</span><br>" , $error_array)) echo "<span style='color:#148C00;'>You are all set! Go ahead and login!</span><br>";?>
		<br><a href="#" id="signin" class="signin">Already have an account,Sign In here!</a>
		</form>
	</div>
</div>

</div>
</body>
</html>
