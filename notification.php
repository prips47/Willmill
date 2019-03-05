<?php require 'common.php';
 $profile_id=$_SESSION['id']?>
<html>
        <?php    include 'head.php'; ?>
        <head>
            <style>
            img {
             border-radius: 50%;
             }
           </style></head>
    <body>
      <?php include 'header.php';?>
        <div class="row" style="padding-top:70px;">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="table-responsive">
                    <table class="table table-bordered" width="600px">
                        <tbody>
                        <th colspan="3">
                            <div class="row rowstyle">
                            <div style="font-size:16px;color:#626567 ;float: left;margin-left: 20px;">Your Notifications</div>
                        </th></tbody></table>
                    <?php
                    $select_query="select * from newsfeed.notification where profile_id=$profile_id ORDER BY time_ DESC";
                    $select_query_result= mysqli_query($con, $select_query)
                            or die($select_query_result);
                    while($row= mysqli_fetch_array($select_query_result))
                    {
                            $action_id=$row['action_id']; 
                            $time=$row['time_'];
                            $select_query1="select first_name,last_name,profilepic from newsfeed.users where id=$action_id";
                            $select_query1_result= mysqli_query($con, $select_query1)
                                    or die(mysqli_error($select_query1_result));
                            $row1= mysqli_fetch_array($select_query1_result);
                            $name=$row1['first_name']." ".$row1['last_name'];
                            $pic_url=$row1['profilepic'];
                          ?>  
                            <table class="table table-bordered" width="600px">
                        <tbody>
                        <tr>
                            <td ><div class="row" style="padding:2px;">
                            <div class="image_box_notn" style="float:left;">
                                <div class="image_notn">
                                     <?php /* echo '<img style="display:block;" width="100%" height="100%" src="data:image;base64,'.$image.'">'; */ ?>
                                    <img style="display:block;" width="100%" height="100%" src="http://dummyimage.com/68x68/000/fff" />
                                    </div>
                                </div>
                                <div style="float:left;">
                                <?php if($row['type_']=="like")
                                {
                                        $post_id=$row['post_id'];
                                 ?>
                                 <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a> liked your <a href="./post.php?post_id=<?php echo "$post_id" ?>">post.</a></div>
                                 <?php 
                                }elseif($row['type_']=="share")
                                    {
                                         $post_id=$row['post_id'];
                                 ?>
                                 <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a> shared your <a href="./post.php?post_id=<?php echo "$post_id" ?>">post.</a></div>
                                 <?php 
                                    } elseif ($row['type_']=="comment") {
                                        $post_id=$row['post_id'];?>
                                    <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a> commented on your<a href="./post.php?post_id=<?php echo "$post_id" ?>">post.</a></div>
                                    <?php
                                    }elseif ($row['type_']=="friend_request") {?>
                                    <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a>sent you friend request.</div>
                                    <?php
                                    }elseif ($row['type_']=="message") {?>
                                    <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a>sent you a message.</div>
                                    <?php
                                    }elseif ($row['type_']=="request_accept") { ?>
                                          <div style="margin-left:7px;"><a href="./pro.php?action_id=<?php echo "$action_id";?>"><?php echo "$name";?></a> accepted your friend request.</div>
                                      <?php }?>
                                    <div style="font-size:13px;color:#626567;margin-left: 7px"><?php echo "$time";?></div>
                                </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <?php
                    }
                    ?>
                       
                    
                </div>
            </div>
        </div>
                    
    </body>
</html>