<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_GET['profile_username'])) {
  $username = $_GET['profile_username'];
  $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $user_array = mysqli_fetch_array($user_details_query);

  $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}



if(isset($_POST['remove_friend'])) {
  $user = new User($conn, $userLoggedIn);
  $user->removeFriend($username);
}

if(isset($_POST['add_friend'])) {
  $user = new User($conn, $userLoggedIn);
  $user->sendRequest($username);
}
if(isset($_POST['respond_request'])) {
  header("Location: requests.php");
}

 ?>

  <style type="text/css">
    .wrapper {
      margin-left: 0px;
      padding-left: 0px;
    }

  </style>
  
  <div class="profile_left">
    <img src="<?php echo $user_array['profile_pic']; ?>">

    <div class="profile_info">
      <p><?php echo "Posts: " . $user_array['num_posts']; ?></p>
      <p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
      <p><?php echo "Friends: " . $num_friends ?></p>
    </div>

    <form action="<?php echo $username; ?>" method="POST">
      <?php 
      $profile_user_obj = new User($conn, $username); 
      if($profile_user_obj->isClosed()) {
        header("Location: user_closed.php");
      }

      $logged_in_user_obj = new User($conn, $userLoggedIn); 

      if($userLoggedIn != $username) {

        if($logged_in_user_obj->isFriend($username)) {
          echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
        }
        else if ($logged_in_user_obj->didReceiveRequest($username)) {
          echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
        }
        else if ($logged_in_user_obj->didSendRequest($username)) {
          echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
        }
        else 
          echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';

      }

      ?>
    </form>

    <?php 
    if($userLoggedIn == $username) {
    echo '<input type="submit" class="deep_blue" data-toggle="modal" data-target="#post_form" value="Post Something">';

}
    ?>

    <?php  
    if($userLoggedIn != $username) {
      echo '<div class="profile_info_bottom">';
        echo $logged_in_user_obj->getMutualFriends($username) . " Mutual friends";
      echo '</div>';
    }


    ?>

  </div>


  <div class="profile_main_column column">
<h1><?php echo $user_array['first_name']." ".$user_array['last_name'] ?></h1>
<ul><li>Branch:<?php echo $user_array['branch']?></li><li  style="margin-left: 100px;">Year:<?php echo $user_array['eng_year']?></li></ul>
<ul><li >Gender:<?php echo $user_array['gender']?></li><li style="margin-left: 100px;">E-mail:<?php echo $user_array['email']?></li></ul>
 
 <?php  $post_images=mysqli_query($conn,"SELECT image from posts where added_by='$username'") ;


if(mysqli_num_rows($post_images) > 0) {

while($row = mysqli_fetch_array($post_images)) {
$imagePath=$row['image'];

echo "<img style='width:150px;height:150px; margin:10px;' src='$imagePath'>";

}
}

?>


 
 
 
 
 
  </div>

<!-- Modal -->
<div class="modal fade" data-backdrop="false" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="postModalLabel">Post something!</h4>
      </div>

      <div class="modal-body">
        <p>This will appear on the user's profile page and also their newsfeed for your friends to see!</p>

        <form class="profile_post" action="" method="POST">
          <div class="form-group">
            <textarea class="form-control" name="post_body"></textarea>
            <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
            <input type="hidden" name="user_to" value="<?php echo $username; ?>">
          </div>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
      </div>
    </div>
  </div>
</div>








  
</body>
</html>