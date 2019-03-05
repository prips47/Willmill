
<?php
require 'common.php';
$id= $_SESSION['user_data']['id'];

if(isset($_POST['post'])){
$post_ = mysqli_real_escape_string($con,$_POST['newspost']);
$post_query="insert into newsfeed.post (texts,user_id) values('$post_','$id')";
$post_query_submit = mysqli_query($con, $post_query) 
        or die(mysqli_error($con));
header("location: index.php ");
}

elseif(isset($_POST['image']))
{
   ?> <html>
    <form method="post" enctype="multipart/form-data" action="image.php">
        <div class="form-group">
            <textarea class="form-control" type="text" name="image_text" placeholder="write something about image.."></textarea>
        </div>
            <br/><input type="file" name="image"/>
            <br/><br/>
            <input type="submit" name="submit" value="upload"/>
    </form></html>
 <?php       
}

elseif (isset ($_POST['video'])) {?>
    <html>
     <form method="post" enctype="multipart/form-data" action="video.php">
         <div class="form-group">
            <textarea class="form-control" type="text" name="video_text" placeholder="write something about video..">
             </textarea>
        </div><br/>
             <input type="file" name="file">
            <br/><br/>
            <input type="submit" name="submit" value="upload"/>
        </form></html>
  <?php
}
 else {
    header("location: index.php ");
}?>

