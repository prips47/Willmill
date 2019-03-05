 <?php
        $con=mysqli_connect("localhost","root","","newsfeed")
        or die(mysqli_error($con));
        session_start();
            $chat_id=$_POST['data1'];
            $profile_id=$_POST['data2'];

                                        $select_query3="select * from connections.chat where sender_id=$profile_id&&receiver_id=$chat_id or receiver_id=$profile_id&&sender_id=$chat_id order by time_ ASC";
                                        $select_query3_result= mysqli_query($con,$select_query3)
                                                or die(mysqli_error($select_query3_result));
                                        $result = '[';
                                     while($row3= mysqli_fetch_array($select_query3_result))
                                             {
                                         $result .= '{"message":"'.trim($row3['message']).'", "time_":"'.$row3['time_'].'", "id_":'.$row3['sender_id'].'},';
                                       }
                                    $result = rtrim($result, ",");
                                    $result .= ']';
                                    echo $result;
                                    ?>