<html>
    <?php 
    include 'head.php'; 
    require 'common.php';
    $profile_id= $_SESSION['user_data']['id'];?>
    <body>
        <?php    include 'header.php';?></body>
    <div class="container" style="margin-top: 60px;">
<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-white border-top-green">
                <div class="panel-body chat"> 
                    <div class="row chat-wrapper">  
                        <div class="col-md-4">
                          <!--  <div class="compose-area"> 
                                <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-edit"></i> New Chat</a>
                            </div> -->
                            
                            <div>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 450px;">
                                <div class="chat-list-wrapper" style="overflow-y: auto; width: auto; height: 450px;">
                                    <ul class="chat-list">
                                        <?php 
                                        
                                        $select_query="select * from connections.chatlist where sender_id=$profile_id OR receiver_id=$profile_id ORDER BY time_ DESC";
                                        $select_query_result= mysqli_query($con, $select_query)
                                                or die(mysqli_error($select_query_result));
                                        while ($row=mysqli_fetch_array($select_query_result))
                                        {
                                            $sender_id=$row['sender_id'];
                                            $receiver_id=$row['receiver_id'];
                                            $recent_chat=$row['recent_chat'];
                                            $time=$row['time_'];
                                            if($sender_id==$profile_id)
                                                {
                                                $chat_id=$receiver_id;
                                                }
                                            elseif($receiver_id==$profile_id){
                                                    $chat_id=$sender_id;
                                            }?>
                                        <li class="new" onclick="current_chat(<?php echo $chat_id?>,<?php echo $profile_id?>);refresh(<?php echo $chat_id?>,<?php echo $profile_id?>);chat_name(<?php echo $chat_id?>)">
                                            <span class="avatar available">
                                                <img src="https://www.nexia-sabt.co.za/wp-content/uploads/2016/05/dummy.jpg" alt="avatar" class="img-circle">
                                            </span>
                                            <div class="body">
                                                <div class="header">
                                                    <span class="username"><?php 
                                                        $select_query1="select first_name,last_name from newsfeed.users where id=$chat_id";
                                                        $select_query1_result= mysqli_query($con, $select_query1)
                                                                or die(mysqli_error($select_query1_result));
                                                        $row1= mysqli_fetch_array($select_query1_result);
                                                        $name=$row1['first_name']." ".$row1['last_name'];
                                                        echo $name;
                                                    ?></span>
                                                    <small class="timestamp text-muted">
                                                        <i class="fa fa-clock-o"></i><?php echo $time?>
                                                    </small>
                                                </div>
                                                <p>
                                                   <?php 
                                                   if(strlen($recent_chat)<=82){
                                                    echo $recent_chat;   
                                                   }else{
                                                       $y=substr($recent_chat,0,82) . '...';
                                                     echo $y;
                                                   }
                                                    ?>
                                                </p>
                                            </div>
                                        </li> <?php 
                                       } ?> 
                                    </ul>    
                                </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 478.639px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-8">
                                <div>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 452px;">
                                <div id="chat_name"></div>
                                    <div class="message-list-wrapper" style="overflow: hidden; width: auto; height: 452px;">
                                    
                                    
                                    <script>
                                        function chat_name(chat_id){
                                            
                                           $.ajax({
                                            url:'chat_name.php',
                                              type:'POST',
                                              data:{data1:chat_id},
                                                  datatype:"json",
                                               success:function(data){
                                               //alert(data);
                                               $("#chat_name").text(data);
                                                }})
                                        }
                                    </script>
                                    
                                    <ul class="message-list" id="chat_id_msg">
                                       
                                    </ul>
                                </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 265px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 187.092px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>

                                <div class="compose-box">
                                    <div class="row">
                                       <div class="col-xs-12 mg-btm-10">
                                           <textarea id="btn-input" class="form-control input-sm" placeholder="Type your message here..." onkeyup="message()"></textarea>
                                        </div>
                                        <div class="col-xs-8">
                                           
                                        </div>
                                        <div class="col-xs-4"> 
                                            <button id="send_button" class="btn btn-green btn-sm pull-right" value="xxx" onclick="sendmessage(<?php echo $profile_id ?>)">
                                                <i class="fa fa-location-arrow"></i> Send
                                            </button>
                                        </div> 
                                    </div> 
                                </div>
                                
                            </div>
                            
                        </div>                                    
                    </div> 
                    
                </div> 
            </div>
        </div>

    </div>
</div>
        </body>
</html>
<script>
$(function(){
$(".chat-list-wrapper").niceScroll();
$(".message-list-wrapper").niceScroll();
});


  
</script>

<script>

function current_chat(chat_id,profile_id){
    var y=document.getElementById("send_button").value=chat_id;
            //alert(y);
    $.ajax({
            url:'chatbackend.php',
            type:'POST',
            data:{data1:chat_id,data2:profile_id},
            datatype:"json",
            success:function(data){
                       //  alert(data);
                var obj= JSON.parse(data);
                document.getElementById("chat_id_msg").innerHTML="";
                for(var i = 0; i < obj.length; i++){
                    var x="Sender: " + obj[i].id_ + " Message: " + obj[i].message + " Timestamp: " + obj[i].time_;
                    var htmlstring=$("#chat_id_msg").html();
                    if(obj[i].id_==chat_id){
                    var newmsg='<li class="left"><small class="timestamp"><i class="fa fa-clock-o">'+obj[i].time_+'</i></small> <div class="body">   <div class="message well well-sm"  >'+obj[i].message+'</div></div></li>';
                    }else if(obj[i].id_==profile_id)
                    {
                        var newmsg='<li class="right"><small class="timestamp"><i class="fa fa-clock-o">'+obj[i].time_+'</i></small> <div class="body">   <div class="message well well-sm"  >'+obj[i].message+'</div></div></li>';
                    }
                document.getElementById("chat_id_msg").innerHTML=htmlstring+newmsg;
               // var scrollpos=$(".message-list-wrapper").scrollTop();
                //console.log(scrollpos);
                //var scrollpos_= parseInt(scrollpos)+450;
                //console.log(scrollpos);
                //var scrollHeight=$(".message-list-wrapper").prop('scrollHeight');
               // console.log(scrollHeight);
               // if(scrollpos_<scrollHeight){ }else{
                $(".message-list-wrapper").scrollTop($(".message-list-wrapper").prop('scrollHeight'));//}
                }
            }
            }
            
    );
   };
    
   var ab; 
    function refresh(chat_id,profile_id){
        clearInterval(ab);
         ab= setInterval(function(){ 
         current_chat(chat_id,profile_id);
    }, 1000);
    }
    
    
    function message(){
     var x=document.getElementById("btn-input").value;
     document.getElementById("btn-input").innerHTML=x;
    };
    
    function sendmessage(profile_id){
     var chat_id=document.getElementById("send_button").value;
    // alert(profile_id);
    var message=document.getElementById("btn-input").innerHTML;
    //alert(message);
    $.ajax({
            url:'sendmessage.php',
            type:'POST',
            data:{data1:chat_id,data2:profile_id,data3:message},
            datatype:"json",
            success:function(data){
                if(data=="success"&&message.length>0) {
                     document.getElementById("btn-input").value="";
                 current_chat(chat_id,profile_id);
                }else if(data!="success")alert("message coudn't sent");
              }
            }
    )};

</script>