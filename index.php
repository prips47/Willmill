<?php
session_start();
if(!isset($_SESSION['id'])) header('Location: ./login.php');
require 'suggestion.php';
//$profession = $_SESSION['id'];
$user_name = $_SESSION['user_data']['first_name'];
$profile_id=$_SESSION['user_data']['id'];
?>
<html>
   <?php    include 'head.php'; ?>
    <body>
    
        <?php
       include 'header.php'; ?>
         <div class="row" style="padding-top:80px;">
            <div class="col-lg-3 "></div>
            <div class="col-lg-6 ">

                    <div class="row" style="border:1px solid #1ABC9C; width:550px; margin-left: 10px;background-color:#EBF5FB;">
                        <form method="post" action="newsfeed.php" enctype="multipart/form-data" style="background-color:#EBF5FB">
                            <div class="form-group" >
                                <textarea  style="height:70px;" class="form-control" type="text" name="newspost" placeholder="What's on your mind.."></textarea>
                            </div>

                            <div style="margin-top: -10px;margin-bottom:-8px; ">
                           <button type="submit" class="btn " name="video" >
                                <span class="glyphicon glyphicon-facetime-video" onclick = "display_form(this);"></span>
                            </button>
                            <button type="submit" class="btn " name="image" >
                                <span class="glyphicon glyphicon-picture" ></span>
                            </button>
                                <button type="submit" class="btn btn-success btn-sm" name="post" style="float:right;">
                                    <span class="glyphicon glyphicon-share-alt"></span> <b>Post</b>
                            </button>
                            </div>
                            <div class = "post-form"></div>

                        </form>
                    </div>

    <?php

            $select_query = "SELECT id,user_id,texts,type,type2,parent_post_id,image_name FROM newsfeed.post ORDER BY time_ DESC limit 15";
            $select_query_result= mysqli_query($con, $select_query) or die(mysqli_error($con));
        while($row= mysqli_fetch_array($select_query_result))
       {
          if($row['type']=="original")
         {
            $post_id=$row['id'];
            $feed=$row['texts'];
            $posters_id=$row['user_id'];
            $image_name=$row['image_name'];
            $con1=mysqli_connect("localhost","root","","connections");
            $select_query4="select id from connections.connected where user_id=$profile_id and connection_id=$posters_id";
            $select_query4_result= mysqli_query($con1, $select_query4)
                    or die(mysqli_error($select_query4_result));
           // $row4= mysqli_fetch_array($select_query4_result);
            $check= mysqli_num_rows($select_query4_result);
            if($check==1 || $posters_id==$profile_id){
            
            $select_query3="select first_name,last_name,profession,place from newsfeed.users  where id=$posters_id";
            $select_query3_result= mysqli_query($con, $select_query3)
                    or die(mysqli_error($select_query3_result));
            $row3= mysqli_fetch_array($select_query3_result);
            $posters_name=$row3['first_name']." ".$row3['last_name'];
            $profession=$row3['profession']." at ".$row3['place'];
            ?>


                <div class="row" style="border:1px solid #1ABC9C; width:550px; margin-left:10px; margin-top:15px" ondblclick="window.location.href = './post.php?post_id=<?php echo $row['id']; ?>';">
                  <div class="row">
                                    <div class="newsfeed_profile_pic">
                                        <img style="display:block;border-radius:50%" width="100%" height="100%" src="data:image/jpeg;base64,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" />
                                    <?php /* echo '<img style="display:block;" width="100%" height="100%" src="data:image;base64,'.$image.'">'; */ ?>
                                    </div>
                                <div id="credential">
                                    <div style="font-size:16px;"><b><?php echo $posters_name; ?></b></div>
                                    <div style="color:#7B7D7D"><?php echo "$profession"; ?></div>
                                </div>
                   </div>
                    <div  class="row" id ="post_content<?php echo $post_id; ?>" onblur="edit(<?php echo $post_id?>);" style="margin-left:15px; margin-top:5px;margin-right: 10px;margin-bottom: 5px" contenteditable="true"><?php echo "$feed"; ?>
                    </div>
                    
                    <script>
                        function edit(post_id){
                            //alert(post_id);
                        var edit =document.getElementById("post_content"+post_id).innerHTML;
                         $.ajax({
                            url:'edit.php',
                            type:'POST',
                            data:{data1:post_id,data2:edit},
                            datatype:"json",
                            success:function(data){
                              //  alert(data);
                            }
                            })
                        }
                     </script>
                     
                    <div class="row" style="max-width:548px; margin: auto" contenteditable="true">
                                   <?php
                                       if ($row['type2']=="image"){
                                       displayimage($image_name);}
                                       elseif($row['type2']=="video")
                                       {
                                           displayvideo($post_id);
            }
                                    ?>
                  </div>
                    <div class="row rowstyle"style="margin-top:10px;">
                        <?php
                            $select_query1="SELECT upvotes FROM newsfeed.post WHERE id=$post_id";
                            $select_query1_result= mysqli_query($con, $select_query1);
                            $row1= mysqli_fetch_array($select_query1_result);
                            $upvotes=$row1['upvotes'];

                            $select_query2="SELECT comment_ FROM newsfeed.comments WHERE post_id=$post_id";
                            $select_query2_result= mysqli_query($con, $select_query2);
                            $comments=mysqli_num_rows($select_query2_result);;
                            ?>
                        <div style="float: left; margin-left:20px;" id = "up<?php echo $post_id; ?>"> <?php if($upvotes>0)
                                echo "$upvotes"." Upvotes" ?>
                        </div>
                        <div style="float: right;margin-right: 18px" > <?php if($comments>0)
                                echo "$comments"." Comments" ?>
                        </div>
                  </div>
                    <div class="row" style="border-top:1px solid #1ABC9C;width: 548px;margin-left:0px;;background-color:#E9F7EF">
                       <div style=" float: left">
                                <div style="margin-top:5px;margin-bottom:-10px;margin-left:5px">
                                <button type="submit" name="upvote"class="btn-success" onclick="$.post('buttons.php',{'upvote':1,'post_id':<?php echo $post_id?>},function(data,status){
                               $('#up<?php echo $post_id?>').text(data);
                               })">
                                   <span class="glyphicon glyphicon-thumbs-up"></span>
                                </button>
                                    <button  name="share" class="btn-success" style="margin-left:12px" onclick="$.post('buttons.php',{'share':1,'post_id':<?php echo $post_id?>},function(data){
                                     show_modal(data);
                                    })">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                    </button>
                                    <div id="myModal" class="modal">
                                    <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p>Post has been shared.</p>
                                    </div>
                                    </div>
<script>
function show_modal(data){
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
  modal.style.display = "block";
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}}
</script>

                                </div>
                       </div>
                        <div>
                            <div style="margin-top:5px;float: right;margin-right: 5px;">
                                    <button class="btn-success" onclick="window.location.href = './post.php?post_id=<?php echo $row['id']; ?>';" >
                                        <span class="glyphicon glyphicon-comment"></span>
                                    </button>
                            </div>
                                 
                       </div>
 </div>
                </div>
                <?php
         }}
       elseif ($row['type']=="shared") {
           $post_id=$row['id'];
            $feed=$row['texts'];
            $posters_id=$row['user_id'];
            $image_name=$row['image_name'];
            $parent_post_id=$row['parent_post_id'];//(id of post which is been shared.)
            $con1=mysqli_connect("localhost","root","","connections");
            $select_query4="select id from connections.connected where user_id=$profile_id and connection_id=$posters_id";
            $select_query4_result= mysqli_query($con1, $select_query4)
                    or die(mysqli_error($select_query4_result));
            $row4= mysqli_fetch_array($select_query4_result);
            $check= mysqli_num_rows($select_query4_result);
            if($check==1 || $posters_id==$profile_id){
            ?>
              <div class="row" style="border:1px solid #1ABC9C; width:550px; margin-left: 10px; margin-top:25px" ondblclick = "window.location.href = './post.php?post_id=<?php echo $row['id']; ?>';">
             <div class="row">
                         <div class="row"style="margin-left: 20px;margin-top: 10px;">
                                    <?php

                                     $select_query2="SELECT parents_id FROM newsfeed.post WHERE id=$post_id";
                                    $select_query2_result= mysqli_query($con, $select_query2)
                                    or die(mysqli_error($select_query_result));
                                     $row3= mysqli_fetch_array($select_query2_result);
                                    $posts_owner_id=$row3['parents_id'];

                                    $select_query4="select first_name,last_name from newsfeed.users where id=$posters_id";
                                    $select_query4_result= mysqli_query($con,$select_query4)
                                            or die(mysqli_error($select_query4_result));
                                    $row4= mysqli_fetch_array($select_query4_result);
                                    $posters_name=$row4['first_name']." ".$row4['last_name'];

                                     $select_query5="select first_name,last_name from newsfeed.users where id=$posts_owner_id";
                                    $select_query5_result= mysqli_query($con,$select_query5)
                                            or die(mysqli_error($select_query5_result));
                                    $row5= mysqli_fetch_array($select_query5_result);
                                    $posts_owner_name=$row5['first_name']." ".$row5['last_name'];
                                     echo"<b>$posters_name</b> shared <b>$posts_owner_name's</b> post.<br/><br/>";?>
                                </div>
                  </div>
                  <div class="row" id ="post_content<?php echo $post_id; ?>" onblur="edit(<?php echo $post_id?>);" contenteditable="true" style="margin-left:15px; margin-top:5px;margin-top: 5px;margin-bottom: 5px;margin-right: 10px;"><?php echo "$feed"; ?>
                  </div>
                    <div class="row" style="max-width:548px; margin: auto" >
                                   <?php
                                       if ($row['type2']=="image"){
                                       displayimage($image_name);}
                                       elseif($row['type2']=="video")
                                       {
                                           displayvideo($post_id);
                                       }
                                    ?>
                  </div>
                    <div class="row rowstyle"style="margin-top:10px;">
                        <?php
                            $select_query1="SELECT upvotes FROM newsfeed.post WHERE id=$post_id";
                            $select_query1_result= mysqli_query($con, $select_query1);
                            $row1= mysqli_fetch_array($select_query1_result);
                            $upvotes=$row1['upvotes'];

                            $select_query3="SELECT comment_ FROM newsfeed.comments WHERE post_id=$post_id";
                            $select_query3_result= mysqli_query($con, $select_query3);
                            $comments=mysqli_num_rows($select_query3_result);;
                            ?>
                        <div style="float: left; margin-left:20px;" id="upv<?php echo $post_id?>"> <?php if($upvotes>0)
                                echo "$upvotes"." Upvotes" ?>
                        </div>
                        <div style="float: right;margin-right: 18px" > <?php if($comments>0)
                                echo "$comments"." Comments" ?>
                        </div>
                  </div>
                    <div class="row" style="border-top:1px solid #1ABC9C;width: 548px;margin-left:0px;;background-color:#E9F7EF">
                       <div style=" float: left">
                               <div style="margin-top:5px;margin-bottom:-10px;margin-left:5px">
                                    <button name="upvote"class="btn-success" onclick="$.post('buttons.php',{'upvote' :1,'post_id':<?php echo $post_id?>},function(data){
                                    if(data>0){data+= 'Upvotes'} else{ data=''}
                                    $('#upv<?php echo $post_id?>').text(data);
                                    })">
                                   <span class="glyphicon glyphicon-thumbs-up"></span>
                                </button>
                                  <button  name="share" class="btn-success" style="margin-left:12px" onclick="$.post('buttons.php',{'share':1,'post_id':<?php echo $post_id?>},function(data){
                                     show_modal(data);
                                    })">
                                    <span class="glyphicon glyphicon-share-alt"></span>
                                    </button>
                                    <div id="myModal" class="modal">
                                    <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p>Post has been shared.</p>
                                    </div>
                                    </div>
<script>
function show_modal(data){
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
  modal.style.display = "block";
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}}
</script>
                                </div>
                       </div>
                        <div>
                            <div style="margin-top:5px;float: right;margin-right: 5px;">
                                    <button  class="btn-success" onclick="window.location.href = './post.php?post_id=<?php echo $row['id']; ?>';" >
                                        <span class="glyphicon glyphicon-comment"></span>
                                    </button>
                            </div>
                                    <form id="textarea" method="post" action="buttons.php" hidden>
                                        <textarea  name="text" ></textarea>
                                    <input value="<?php echo "$post_id" ?>" name="post_id" hidden >
                                    <input type="submit" value="Post" name="button">
                                    </form>
                        </div>  </div>


                   </div>

   <?php
       }}
}
          function displayimage($image_name)
                                     {
                                       $con=mysqli_connect("localhost","root","","newsfeed")
                                        or die(mysqli_error($con));
                                      $select_query3="SELECT image FROM images where name='$image_name'";
                                      $select_query3_result= mysqli_query($con, $select_query3)
                                      or die(mysqli_error($select_query3_result));
                                      $row= mysqli_fetch_array($select_query3_result) ;
                                      echo '<img style="max-width:100%; max-height:100%;margin:auto;display:block;" src="data:image;base64,'.$row['image'].'">';
                                       }

                                       function displayvideo($post_id)
                                       {
                                       $con=mysqli_connect("localhost","root","","newsfeed")
                                        or die(mysqli_error($con));
                                      $select_query3="SELECT url FROM videos where id=$post_id";
                                      $select_query3_result= mysqli_query($con, $select_query3)
                                      or die(mysqli_error($select_query3_result));
                                      $row= mysqli_fetch_array($select_query3_result) ;
                                      $url=$row['url'];
                                      echo "<video width='400' height='400' controls>
                                            <source src='$url' ></video>";
                                       }

     ?></div>

            <div class="col-lg-3"></div>
    </div>


</body>
</html>
