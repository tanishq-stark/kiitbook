<?php

$fname="";
$lname="";
$gender="";
$eng_year="";
$branch="";
$email1="";
$email2="";
$error_array=array();

//Storing data in variables if button is pressed
if(isset($_POST['reg_clicked']))
{
	$fname=strip_tags($_POST['reg_fname']);//Removing < > tag symbols
	$fname=ucfirst(strtolower($fname));//converting first alphbet to uppercase and rest to lowercase
	$fname=str_replace(" ", "", $fname);//removing space
	$_SESSION['reg_fname']=$fname;

	$lname=strip_tags($_POST['reg_lname']);//Removing < > tag symbols
	$lname=ucfirst(strtolower($lname));//converting first alphbet to uppercase and rest to lowercase
	$lname=str_replace(" ", "", $lname);//removing space
	$_SESSION['reg_lname']=$lname;

	$gender=($_POST['gender']);
	$eng_year=($_POST['year']);
	$branch=($_POST['branch']);


	$email1=strip_tags($_POST['reg_email']);//Removing < > tag symbols
	$email1=strtolower($email1);//converting first alphbet to uppercase and rest to lowercase
	$email1=str_replace(" ", "", $email1);//removing space
	$_SESSION['reg_email']=$email1;

	
	$email2=strip_tags($_POST['reg_conemail']);//Removing < > tag symbols
	$email2=strtolower($email2);//converting first alphbet to uppercase and rest to lowercase
	$email2=str_replace(" ", "", $email2);//removing space
	$_SESSION['reg_conemail']=$email2;

	
	$pwd1=strip_tags($_POST['reg_pwd']);
	$pwd2=strip_tags($_POST['reg_conpwd']);
	$date= date("d-m-y");



	if($email1==$email2)
	{
if(filter_var($email1,FILTER_VALIDATE_EMAIL))
{
	$em=filter_var($email1,FILTER_VALIDATE_EMAIL);

	//Check if email already exists
	$e_check=mysqli_query($conn,"SELECT email from users WHERE email='$em'");

	//Count number of rows returned
	$num_rows=mysqli_num_rows($e_check);
	if($num_rows>0)
	{
		array_push($error_array,"Email already in use<br>");
	}
}
else
	array_push($error_array,"Invalid Email<br>");

	}
	else
	{
		array_push($error_array,"Emails dont match<br>");
	}

//Validating other inputs


	if(strlen($fname)>25||strlen($fname)<2)
	{
		array_push($error_array,"Your first name must be between 2 and 25 characters<br>");
	}
	if(strlen($lname)>25||strlen($lname)<2)
	{
		array_push($error_array,"Your last name must be between 2 and 25 characters<br>");
	}

	if($pwd1!=$pwd2)
	{
		array_push($error_array,"Your passwords do not match<br>");
	}
	else
	{
		if(preg_match('/[^A-Za-z0-9]/',$pwd1)){
			array_push($error_array,"Your password can contain english characters and numbers only<br>");
		}
	}

	if(strlen($pwd1>30||strlen($pwd1)<5)){
		array_push($error_array,"Your password mus be between 5 and 30 characters<br>");
	}

	if(empty($error_array)){
		$pwd1=md5($pwd1);//Enctypts passwdord before sending to database

		//Generate username by concatinating fname and lname
		$username=strtolower($fname."_".$lname);
		$check_username_query=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");

		$i=0;
		while(mysqli_num_rows($check_username_query)!=0){
			$i++;
			$username=$username."_".$i;
			$check_username_query=mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");

		}

		if($gender=="male"){
		  $profile_pic="assets/images/profile_pics/default/male_avatar.jpg";}
		else {
			  $profile_pic="assets/images/profile_pics/default/female_avatar.jpg";}
			  
			  echo $fname.$lname.$gender
.$eng_year
.$branch
.$email1
.$email2;

			mysqli_query($conn,"INSERT INTO users(first_name,last_name,username,email,eng_year,branch,password,signup_date,profile_pic,num_posts,num_like,user_closed,friend_array,gender) VALUES('$fname','$lname','$username','$email1','$eng_year','$branch','$pwd1','$date','$profile_pic','0','0','no',',','$gender')");
	        array_push($error_array,"<span style='color:#148C00;'>You are all set! Go ahead and login!</span><br>");
	        $_SESSION['reg_fname']="";
	        $_SESSION['reg_lname']="";
	        $_SESSION['reg_email']="";
	        $_SESSION['reg_conemail']="";



	}


}
?>