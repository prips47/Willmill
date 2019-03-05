<?php

        require 'common.php';
        $profile_id=$_SESSION['id'];
             if(isset($_POST['add_friend']))
             {   $request_id=$profile_id;
                 $profile_id=$_POST['suggestion_id']; //profile to whom frined request is to be shown.
                 
                  $con=mysqli_connect("localhost","root","")
                  or die(mysqli_error($con));
                  $db1=mysqli_select_db($con,"connections")
                  or die(mysqli_error($con));
                  
                  $insert_query="insert into connections.friend_request (profile_id,request_id) values ($profile_id,$request_id)";
                  $insert_query_result= mysqli_query($con, $insert_query)
                          or die(mysqli_error($insert_query_result));
                  
                  $delete_query="delete from connections.suggestion where profile_id=$request_id and suggestion_id=$profile_id ";
                  $delete_query_result= mysqli_query($con, $delete_query)
                          or die(mysqli_error($delete_query_result));
                  
                $insert_query8="INSERT into newsfeed.notification (profile_id,type_,action_id) values($profile_id,'friend_request',$request_id)";
                 $insert_query8_result= mysqli_query($con, $insert_query8)
                  or die(mysqli_error($insert_query8_result));
                 header("location:index.php ");
             }
             
             if(isset($_POST['confirm_request']))
             {   
                 $request_id=$_POST['request_id']; //profile to whom frined request is to be shown.
                 $con=mysqli_connect("localhost","root","")
                  or die(mysqli_error($con));
                  $db1=mysqli_select_db($con,"connections")
                  or die(mysqli_error($con));
                  
                  $insert_query="insert into connections.connected (user_id,connection_id) values ($profile_id,$request_id)";
                  $insert_query_result= mysqli_query($con, $insert_query)
                          or die(mysqli_error($insert_query_result));
                  
                  $insert_query1="insert into connections.connected (user_id,connection_id) values ($request_id,$profile_id)";
                  $insert_query1_result= mysqli_query($con, $insert_query1)
                          or die(mysqli_error($insert_query1_result));
                 
                  $delete_query="delete from connections.friend_request where profile_id=$profile_id and request_id=$request_id";
                  $delete_query_result= mysqli_query($con, $delete_query)
                          or die(mysqli_error($delete_query_result));
                  
                  $insert_query8="INSERT into newsfeed.notification (profile_id,type_,action_id) values($request_id,'request_accept',$profile_id)";
                 $insert_query8_result= mysqli_query($con, $insert_query8)
                  or die(mysqli_error($insert_query8_result));
                 
                 header("location:index.php ");
             }
             
             ?>


