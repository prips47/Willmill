<?php

        require 'common.php';
        $profile_id=$_SESSION['id'];
             if(isset($_POST['Connect']))
             {
                 $connection_id=$_POST['suggestion_id'];
                 
                  $con=mysqli_connect("localhost","root","")
                  or die(mysqli_error($con));
                  $db1=mysqli_select_db($con,"connections")
                  or die(mysqli_error($con));
                  
                  $insert_query="insert into connections.connected (user_id,connection_id) values ($profile_id,$connection_id)";
                  $insert_query_result= mysqli_query($con, $insert_query)
                          or die(mysqli_error($insert_query_result));
                  
                  $insert_query1="insert into connections.connected (user_id,connection_id) values ($connection_id,$profile_id)";
                  $insert_query1_result= mysqli_query($con, $insert_query1)
                          or die(mysqli_error($insert_query1_result));
                 
                  $delete_query="delete from connections.suggestion where suggestion_id=$connection_id";
                  $delete_query_result= mysqli_query($con, $delete_query)
                          or die(mysqli_error($delete_query_result));
                  
                  $insert_query8="INSERT into newsfeed.notification (profile_id,type_,action_id) values($connection_id,'friend_request',$profile_id)";
                 $insert_query8_result= mysqli_query($con, $insert_query8)
                  or die(mysqli_error($insert_query8_result));

             }?>


