<?php

include("includes/header.php");

$profile_id = $user['username'];
$imgSrc = "";
$result_path = "";
$msg = "";


$image = $_POST['image'];

list($type, $image) = explode(';',$image);
list(, $image) = explode(',',$image);

$image = base64_decode($image);
$image_name = time().'.png';
file_put_contents('assets/images/profile_pics/'.$image_name, $image);
$fullpath='assets/images/profile_pics/'.$image_name;

echo 'successfully uploaded';

$insert_pic_query = mysqli_query($conn, "UPDATE users SET profile_pic='$fullpath' WHERE username='$userLoggedIn'");
		header("Location: ".$userLoggedIn);

?>