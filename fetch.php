<?php
if(isset($_POST["view"]))
{
  include 'common.php';
  $id=$_SESSION['id'];
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE newsfeed.notification SET status_=1 WHERE status_=0 AND profile_id=$id";
  $update_query_result=mysqli_query($con, $update_query)
          or die(mysqli_error($update_query_result));
 }
 $query = "SELECT * FROM notification where profile_id=$id ORDER BY time_ DESC LIMIT 7";
 $result = mysqli_query($con, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {   
      $action_id=$row['action_id'];
      $select_query="select first_name,last_name from users where id=$action_id";
      $select_query_result= mysqli_query($con, $select_query);
      $row1= mysqli_fetch_array($select_query_result);
      $name=$row1['first_name']." ".$row1['last_name'];
   if($row['type_']=="share")
      {
          $output .= '
        <li>
        <a href="./post.php?post_id='.$row['post_id'].'">
        <strong>'.$name.'</strong> shared your post
        <small><em>'.$row["post_id"].'</em></small>
        </a>
        </li>
        <li class="divider"></li>
         ';}
         elseif ($row['type_']=="like") {
           $output .= '
        <li>
        <a href="./post.php?post_id='.$row['post_id'].'">
        <strong>'.$name.'</strong> liked your post
        <small><em>'.$row["post_id"].'</em></small>
        </a>
        </li>
        <li class="divider"></li>
        ';}
        elseif ($row['type_']=="comment") {
           $output .= '
        <li>
        <a href="./post.php?post_id='.$row['post_id'].'">
        <strong>'.$name.'</strong> commented on your post
        <small><em>'.$row["post_id"].'</em></small>
        </a>
        </li>
        <li class="divider"></li>
        ';}
        elseif ($row['type_']=="friend_request") {
           $output .= '
        <li>
        <a href="./pro.php?action_id='.$row['action_id'].'">
        <strong>'.$name.'</strong> sent you a friend request
        </a>
        </li>
        <li class="divider"></li>
        ';}
        elseif ($row['type_']=="request_accept") {
           $output .= '
        <li>
        <a href="./pro.php?action_id='.$row['action_id'].'">
        <strong>'.$name.'</strong> accepted your friend request
        </a>
        </li>
        <li class="divider"></li>
        ';}
        elseif ($row['type_']=="message") {
           $output .= '
        <li>
        <a href="./chat.php">
        <strong>'.$name.'</strong> sent you a message
        </a>
        </li>
        <li class="divider"></li>
        ';}
        
  }
        $output .= '
        <li class = "text-center" onclick = "window.location.href = \'./notification.php\';" style = "cursor: pointer;">
            See more
        </li>
        <li class="divider"></li>
    ';
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 
 $query_1 = "SELECT * FROM notification WHERE status_=0 AND profile_id=$id";
 $result_1 = mysqli_query($con, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>