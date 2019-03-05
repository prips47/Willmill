<?php
include 'common.php';
$post_id=$_POST['data1'];

$select_query="select * from newsfeed.comments where post_id=$post_id order by time_ desc";
$select_query_result= mysqli_query($con, $select_query);
$result ='[';
while($row= mysqli_fetch_array($select_query_result))
{
    $comment=$row['comment_'];
    $commenter=$row['user_id'];
    $select_query1="select first_name,last_name from users where id=$commenter";
    $select_query1_result= mysqli_query($con, $select_query1);
    $row1= mysqli_fetch_array($select_query1_result);
    $name=$row1['first_name']." ".$row1['last_name'];
     $result .= '{"commenter":"'.$name.'", "time_":"'.$row['time_'].'", "comment":"'.$comment.'"},';
}
$result = rtrim($result, ",");
$result .= ']';
echo $result;
?>