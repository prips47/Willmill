<?php require 'common.php';
 $profile_id=$_SESSION['id']?>
<html>
    
        <head>
            <style>
            img {
             border-radius: 50%;
             }
           </style>
        <title>Will Mill</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
         <script src="bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css">
    
    </head>
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
                            <div style="font-size:16px;color:#626567 ;float: left;margin-left: 20px;">Friend Requests</div>
                        </th>
                            <?php 
  $con=mysqli_connect("localhost","root","")
        or die(mysqli_error($con));
$db1=mysqli_select_db($con,"connections")
        or die(mysqli_error($con));                          

$select_query="select * from friend_request where profile_id=$profile_id";
$select_query_result= mysqli_query($con, $select_query)
        or die(mysqli_error($select_query_result));
$x= mysqli_num_rows($select_query_result);
if($x%3==1)
{
    $n=$x;
$select_query2="select * from friend_request where profile_id=$profile_id  ORDER BY time_ DESC Limit $n" ;
$select_query2_result= mysqli_query($con, $select_query2)
        or die(mysqli_error($select_query2_result));
} elseif ($x%3==2)
{   
    $n=$x;
    $select_query2="select * from friend_request where profile_id=$profile_id  ORDER BY time_ DESC Limit $n";
    $select_query2_result= mysqli_query($con, $select_query2)
        or die(mysqli_error($select_query2_result));

}elseif($x%3==0)
{
    $select_query2="select * from friend_request where profile_id=$profile_id  ORDER BY time_ DESC ";
    $select_query2_result= mysqli_query($con, $select_query2)
        or die(mysqli_error($select_query2_result));
}

$i=0;
while($row= mysqli_fetch_array($select_query2_result))
{   
$request_id=$row['request_id'];
$mutuals=0;

$db2=mysqli_select_db($con,"newsfeed")
        or die(mysqli_error($db2));

$select_query1="select first_name,last_name,profilepic,profession,place from users where id=$request_id";
$select_query1_result= mysqli_query($con, $select_query1)
        or die(mysqli_error($select_query1_result));

$row1= mysqli_fetch_array($select_query1_result);
$name=$row1['first_name']." ".$row1['last_name'];
$profession=$row1['profession'];
$place=$row1['place'];
$image=$row1['profilepic'];
    $i=$i+1;
    if($i%3==1)
        { ?>
                        <tr>
                                <td width="200px" style="text-align:center">
                                <div class="image_box" >
                                    <div class="image_">
                                        <img style="display:block;" width="100%" height="100%" src="data:image/jpeg;base64,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" />
                                    <?php /* echo '<img style="display:block;" width="100%" height="100%" src="data:image;base64,'.$image.'">'; */ ?>
                                    </div>
                                </div>
                                    <div style="font-size:15px"><b><?php echo "$name";?></b></div>
                                <div style="font-size:14px;color:#626567"><?php echo "$profession"." at "."$place";?></div>
                               <div style="font-size:13px;color:#626567"><?php echo "$mutuals";?> mutual connections</div>
                                <div class="connect">
                                    <form method="post" action="friend_request.php" >
                                        <input type="text" name="request_id" value="<?php echo "$request_id";?>" hidden>
                                        <input type="submit" class="btn-primary " value="Confirm Request" name="confirm_request" >
                                    </form>
                                </div>
                                </td>
  <?php }elseif ($i%3==2) 
            { ?>
                   
                                <td width="200px" style="text-align:center">
                                <div class="image_box" >
                                    <div class="image_">
                                     <?php /* echo '<img style="display:block;" width="100%" height="100%" src="data:image;base64,'.$image.'">'; */ ?>
                                    <img style="display:block;" width="100%" height="100%" src="http://dummyimage.com/68x68/000/fff" />
                                    </div>
                                </div>
                                    <div style="font-size:15px"><b><?php echo "$name";?></b></div>
                                <div style="font-size:14px;color:#626567"><?php echo "$profession"." at "."$place";?></div>
                                <div style="font-size:13px;color:#626567"><?php echo "$mutuals";?> mutual connections</div>
                                <div class="connect" ><form  method="POST" action="friend_request.php">
                                         <input type="text" name="request_id" value="<?php echo "$request_id";?>" hidden>
                                        <input type="submit" class="btn-primary" value="Confirm Request" name="confirm_request">
                                    </form>
                                </div>
                                </td>                     
      <?php }
     elseif ($i%3==0) 
            { ?>
                   
                                <td width="200px" style="text-align:center">
                                <div class="image_box" >
                                    <div class="image_">
                                      <?php /* echo '<img style="display:block;" width="100%" height="100%" src="data:image;base64,'.$image.'">'; */ ?>
                                    <img style="display:block;" width="100%" height="100%" src="data:image/jpeg;base64,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" />
                                    </div>
                                </div>
                                    <div style="font-size:15px"><b><?php echo "$name";?></b></div>
                                <div style="font-size:14px;color:#626567"><?php echo "$profession"." at "."$place";?></div>
                                <div style="font-size:13px;color:#626567"><?php echo "$mutuals";?> mutual connections</div>
                                <div class="connect"><form method="POST" action="friend_request.php">
                                         <input type="text" name="request_id" value="<?php echo "$request_id";?>" hidden>
                                        <input type="submit" class="btn-primary " value="Confirm Request" name="confirm_request" >
                                    </form>
                                </div>
                                </td> 
                        </tr>
      <?php }
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="col-lg-3"></div>
        </div>
        
    </body>
</html>

  <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();
 }, 5000);
 
});
</script>