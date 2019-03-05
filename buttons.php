<?php
require 'common.php';
$id= $_SESSION['id'];
$post_id= mysqli_real_escape_string($con,$_POST['post_id']);
//print_r($_POST);

    if(isset($_POST['upvote']))
    {
        $select_query="SELECT id FROM newsfeed.upvotes WHERE post_id=$post_id AND upvoter_id=$id";
        $select_query_result= mysqli_query($con, $select_query);
        $row= mysqli_fetch_array($select_query_result);
        
        $select_query3="SELECT user_id,type2 FROM newsfeed.post WHERE id=$post_id";
        $select_query3_result= mysqli_query($con, $select_query3);
        $row3= mysqli_fetch_array($select_query3_result);
        $posts_owner_id=$row3['user_id'];
        
        $upvotes = 0;
        if($row)
        {
            
            $like_return_query="DELETE FROM newsfeed.upvotes WHERE post_id=$post_id AND upvoter_id=$id ";
            $like_return_query_result= mysqli_query($con,$like_return_query)
            or die(mysqli_error($like_return_query_result));
            
            $select_query1="SELECT upvotes FROM newsfeed.post WHERE id=$post_id";
            $select_query1_result= mysqli_query($con, $select_query1);
            $row1= mysqli_fetch_array($select_query1_result);
            $upvotes=$row1['upvotes'];
            $upvotes=$upvotes-1;
            
            $update_query1="UPDATE newsfeed.post SET upvotes=$upvotes WHERE id=$post_id";
            $update_query1_result= mysqli_query($con, $update_query1) or
            die(mysqli_error($update_query1_result));
            
            
        }
        else {
            
            $insert_query7="INSERT into newsfeed.notification (profile_id,post_id,type_,action_id) values($posts_owner_id,$post_id,'like',$id)";
            $insert_query7_result= mysqli_query($con, $insert_query7)
                or die(mysqli_error($insert_query7_result));
            
            $insert_query="INSERT INTO newsfeed.upvotes (post_id,upvoter_id) values($post_id,$id)";
            $insert_query_result= mysqli_query($con, $insert_query)
                    or die(mysqli_error($insert_query_result));
            
            $select_query2="SELECT upvotes FROM newsfeed.post WHERE id=$post_id";
            $select_query2_result= mysqli_query($con, $select_query2);
            $row2= mysqli_fetch_array($select_query2_result);
            $upvotes=$row2['upvotes'];
            $upvotes=$upvotes+1;
            
            $update_query="UPDATE newsfeed.post SET upvotes=$upvotes WHERE id=$post_id";
            $update_query_result= mysqli_query($con, $update_query) or
            die(mysqli_error($update_query_result));
            
            
             }
             
             //header("location:index.php");
             echo $upvotes;
               
    }
    elseif(isset($_POST['comment']))
    {   
        $select_query3="SELECT user_id,type2 FROM newsfeed.post WHERE id=$post_id";
        $select_query3_result= mysqli_query($con, $select_query3);
        $row3= mysqli_fetch_array($select_query3_result);
        $posts_owner_id=$row3['user_id'];
        
         $comment=$_POST['text'];
         $insert_query7="insert into newsfeed.comments (post_id,user_id,comment_) values($post_id,$id,'$comment')";
         $insert_query7_result= mysqli_query($con,$insert_query7)
                 or die(mysqli_error($insert_query7_result));
         
         $insert_query8="INSERT into newsfeed.notification (profile_id,post_id,type_,action_id) values($posts_owner_id,$post_id,'comment',$id)";
         $insert_query8_result= mysqli_query($con, $insert_query8)
                or die(mysqli_error($insert_query8_result));
        
          //header("location:index.php");
    }
   elseif(isset($_POST['share']))
    {
        
        $select_query3="SELECT user_id,type2 FROM newsfeed.post WHERE id=$post_id";
        $select_query3_result= mysqli_query($con, $select_query3);
        $row3= mysqli_fetch_array($select_query3_result);
        $posts_owner_id=$row3['user_id'];
        
        $insert_query3="INSERT into newsfeed.shares (post_id,user_id,posts_owner_id) values($post_id,$id,$posts_owner_id)";
        $insert_query3_result= mysqli_query($con, $insert_query3)
                or die(mysqli_error($insert_query3_result));
        
        $insert_query7="INSERT into newsfeed.notification (profile_id,post_id,type_,action_id) values($posts_owner_id,$post_id,'share',$id)";
        $insert_query7_result= mysqli_query($con, $insert_query7)
                or die(mysqli_error($insert_query7_result));
        
        $select_query4="SELECT texts,image_name FROM newsfeed.post WHERE id=$post_id";
        $select_query4_result= mysqli_query($con, $select_query4);
        $row4= mysqli_fetch_array($select_query4_result);
        $shared_post= mysqli_real_escape_string($con,$row4['texts']);
        $image_name= mysqli_real_escape_string($con,$row4['image_name']);
        if($row3['type2']=="image")
        {
              $insert_query4="INSERT into newsfeed.post (texts,user_id,type,parents_id,type2,parent_post_id,image_name) values('$shared_post',$id,'shared',$posts_owner_id,'image',$post_id,'$image_name')";
              $insert_query4_result= mysqli_query($con, $insert_query4)
                or die(mysqli_error($insert_query4_result));
              
             
                 echo "$post_id";
        }
        else 
            {
              $insert_query4="INSERT into newsfeed.post (texts,user_id,type,parents_id) values('$shared_post',$id,'shared',$posts_owner_id)";
              $insert_query4_result= mysqli_query($con, $insert_query4)
                or die(mysqli_error($insert_query4_result));
        echo "$post_id";
             }
        
             
    }
    

?>

