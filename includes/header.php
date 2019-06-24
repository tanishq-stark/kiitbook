<?php
require 'config/config.php';

if(isset($_SESSION['username'])){
	$userLoggedIn=$_SESSION['username'];
	$user_details_query=mysqli_query($conn,"SELECT * FROM users WHERE username='$userLoggedIn'");
	$user=mysqli_fetch_array($user_details_query);
}
else{
	header("Location: register.php");
}
?>

<html>
<head>
	<title>Kiitbook</title>
	<title>Kiitbook</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	








	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
	
     
     
     
  
     
     
	

</head>
<html>
<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index2.php"><img style="height:40px;" src="assets/images/ki2.png"></a>
		</div>
		
		
		
		<div class="search">

			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

				<div class="button_holder">
					<img src="assets/images/icons/magnifying_glass.png">
				</div>

			</form>

			<div class="search_results">
			</div>

			<div class="search_results_footer_empty">
			</div>



		</div>


		<nav>
			<a href="#" ><i class="material-icons" style="font-size:20px;color:#636870;margin-top:10px;">account_circle</i></a>
			<a href="<?php echo $userLoggedIn;?>" style="font-size:23px;color:#636870;padding-bottom:10px;text-decoration:none;"><?php echo $user['first_name'];?></a>
			<a href="#"><i class="material-icons" style="font-size:20px;margin-left:20px;margin-top:10px;">notifications</i></a>
			<a href="requests.php"><i class="material-icons" style="font-size:20px;margin-left:20px;margin-top:10px;">people</i></a>
			<a href="#"><i class="material-icons" style="font-size:20px;margin-left:20px;margin-top:10px;">messenger</i></a>
			<a href="#"><i class="material-icons" style="font-size:20px;margin-left:20px;margin-top:10px;">settings</i></a>
			<a href="#"><i class="material-icons" style="font-size:20px;margin-left:20px;margin-top:10px;">arrow_drop_down</i></a>
			<a href="includes/handlers/logout.php"><i class="fa fa-sign-out" style="font-size:20px;margin-left:15px;margin-right:8px;margin-top:10px;margin-right:90px"></i></a>
		</nav>
	</div>

	<div class="wrapper">