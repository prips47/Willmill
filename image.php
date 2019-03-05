<?php
        require 'common.php';
             if(isset($_POST['submit']))
             {    
                 if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
                 {
                     echo "please select an image";
                 }
                 else 
                     {
                     $image= addslashes($_FILES['image']['tmp_name']);
                     $name=addslashes($_FILES['image']['name']);
                     $image= file_get_contents($image);
                     $image= base64_encode($image);
                     $image_text=$_POST['image_text'];
                     saveimage($name,$image,$image_text);
                     
                 }
               
             }
             function saveimage($name,$image,$image_text)
             {  
                 $con=mysqli_connect("localhost","root","","newsfeed")
                 or die(mysqli_error($con));
                 mysqli_select_db($con,"newsfeed");
                 $id=$_SESSION['user_data']['id'];
                 
                   $select_query2="select id from post where user_id=$id ORDER BY time_ DESC LIMIT 1";
                 $select_query2_result= mysqli_query($con, $select_query2)
                         or die(mysqli_error($select_query2_result));
                 $row= mysqli_fetch_array($select_query2_result);
                 $recent_post_id=$row['id'];
                 $name=$name.$recent_post_id;
                 
                 $insert_query1="insert into post(texts,user_id,type2,image_name) values('$image_text',$id,'image','$name')";
                 $insert_query1_result= mysqli_query($con,$insert_query1)
                         or die(mysqli_error($insert_query1));
                 
                 $select_query1="select id from post where texts='$image_text' AND user_id=$id AND type2='image' AND image_name='$name'";
                 $select_query1_result= mysqli_query($con,$select_query1)
                         or die(mysqli_error($select_query1));
                 $row1= mysqli_fetch_array($select_query1_result);
                 $post_id=$row1['id'];
                 
                 $insert_query="INSERT INTO images (id,name,image) values($post_id,'$name','$image')";
                 $result= mysqli_query($con, $insert_query) or
                         die(mysqli_error($result));
                 if($result){header("location: index.php ");}
                 else{echo "<br/>image not uploaded.";}
             }
   