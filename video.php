<?php
        require 'common.php';
        $id=$_SESSION['id'];
        
        if(isset($_POST['submit']))
{
    $name=$_FILES['file']['name'];
    $temp=$_FILES['file']['tmp_name'];
    $name=$name.$id;
    $video_text=$_POST['video_text'];
    move_uploaded_file($temp,"uploaded/".$name);
    $url="./uploaded/$name";
    
                 $insert_query1="insert into post(texts,user_id,type2) values('$video_text',$id,'video')";
                 $insert_query1_result= mysqli_query($con,$insert_query1)
                         or die(mysqli_error($insert_query1));
                 
                 $select_query1="select id from post where texts='$video_text' AND user_id=$id AND type2='video'";
                 $select_query1_result= mysqli_query($con,$select_query1)
                         or die(mysqli_error($select_query1));
                 $row1= mysqli_fetch_array($select_query1_result);
                 $post_id=$row1['id'];
                 
                 $insert_query="INSERT INTO videos (id,name,url) values($post_id,'$name','$url')";
                 $result= mysqli_query($con, $insert_query) or
                         die(mysqli_error($result));
                 if($result)
                 {
                     header("location: index.php ");
                 }
                 else
                 {
                     echo "<br/>video not uploaded.";
                 }
}
 ?>