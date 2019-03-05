//1.0+
<?php 
$profile_id=$_SESSION['id'];

$con=mysqli_connect("localhost","root","")
        or die(mysqli_error($con));
$db1=mysqli_select_db($con,"newsfeed")
        or die(mysqli_error($con));

$select_query1="select id from users where id!=$profile_id";
$select_query1_result= mysqli_query($con, $select_query1)
        or die(mysqli_error($select_query1_result));

$db2= mysqli_select_db($con,"connections") 
  or die(mysqli_error($con));
$query="delete from suggestion where profile_id=$profile_id";
$query_result=mysqli_query($con,$query)
        or die(mysqli_error($query_result));

while($row1= mysqli_fetch_array($select_query1_result))
{
    $id=$row1['id'];
    $select_query3="select id from connections.connected where user_id=$profile_id AND connection_id=$id";
    $select_query3_result= mysqli_query($con, $select_query3)
            or die(mysqli_error($select_query3_result));
    $x=mysqli_num_rows($select_query3_result);
    
    $select_query4="select id from connections.friend_request where ( profile_id=$profile_id  AND request_id=$id) OR ( profile_id=$id  AND request_id=$profile_id) ";
    $select_query4_result= mysqli_query($con, $select_query4)
            or die(mysqli_error($select_query4_result));
    $y=mysqli_num_rows($select_query4_result);
    
    if($x==0&&$y==0)
    {
        $suggestion_id=$id;
        $select_query="select connection_id from connections.connected where user_id=$suggestion_id";
        $select_query_result= mysqli_query($con,$select_query)
        or die(mysqli_error($select_query_result));
        $mutuals=0;
        while($row= mysqli_fetch_array($select_query_result))
        {
        $mutual_id=$row['connection_id'];
        $select_query2="select id from connections.connected where user_id=$profile_id AND connection_id=$mutual_id";
        $select_query2_result= mysqli_query($con, $select_query2)
        or die(mysqli_error($select_query2_result));
        $y= mysqli_num_rows($select_query2_result);
            if($y!=0)
            {
            $mutuals=$mutuals+1;
            }
        }
          $insert_query="insert into connections.suggestion (profile_id,suggestion_id,mutual_connections) values($profile_id,$suggestion_id,$mutuals)";
          $insert_query_result= mysqli_query($con, $insert_query)
          or die(mysqli_error($insert_query));
            
   }
}
?>
