<?php
$con=mysqli_connect("localhost","root","","connections")
        or die(mysqli_error($con));
            $chat_id=$_POST['data1'];
            $profile_id=$_POST['data2'];
            $message=$_POST['data3'];
            $length= strlen($message);
            if($length>0){
            $insert_query="insert into chat (sender_id,receiver_id,message) values($profile_id,$chat_id,'$message')";
            $insert_query_result= mysqli_query($con, $insert_query);
            }
            $delete_query="delete from chatlist where sender_id=$profile_id and receiver_id=$chat_id";
            $delete_query_result= mysqli_query($con, $delete_query);
            
            $delete_query1="delete from chatlist where sender_id=$chat_id and receiver_id=$profile_id";
            $delete_query1_result= mysqli_query($con, $delete_query1);
            
            $insert_query1="insert into chatlist (sender_id,receiver_id,recent_chat) values($profile_id,$chat_id,'$message')";
            $insert_query1_result= mysqli_query($con, $insert_query1);
            
            $con1=mysqli_connect("localhost","root","","newsfeed");
            $delete_query2="delete from notification where profile_id=$chat_id and action_id=$profile_id and type_='message'";
            $delete_query2_result= mysqli_query($con1,$delete_query2);
            $insert_query2="insert into notification (profile_id,action_id,type_) values($chat_id,$profile_id,'message')";
            $insert_query2_result=mysqli_query($con1,$insert_query2);
            
            echo "success";
            
?>