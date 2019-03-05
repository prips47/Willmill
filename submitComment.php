<?php
include 'common.php';
$post_id=$_POST['data1'];
$profile_id=$_POST['data2'];
$comment= mysqli_real_escape_string($con,$_POST['data3']);

$insert_query="insert into comments (post_id,user_id,comment_) values ($post_id,$profile_id,'$comment')";
$insert_query_result= mysqli_query($con, $insert_query);

        $select_query3="SELECT user_id,type2 FROM newsfeed.post WHERE id=$post_id";
        $select_query3_result= mysqli_query($con, $select_query3);
        $row3= mysqli_fetch_array($select_query3_result);
        $posts_owner_id=$row3['user_id'];
        
        $insert_query8="INSERT into newsfeed.notification (profile_id,post_id,type_,action_id) values($posts_owner_id,$post_id,'comment',$profile_id)";
         $insert_query8_result= mysqli_query($con, $insert_query8)
                or die(mysqli_error($insert_query8_result));
echo $insert_query_result;
?>

