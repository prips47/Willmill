 <?php
        $con=mysqli_connect("localhost","root","","newsfeed")
        or die(mysqli_error($con));
        session_start();
            $chat_id=$_POST['data1'];
           
            $select_query="select first_name,last_name from users where id=$chat_id";
            $select_query_result= mysqli_query($con, $select_query)
                    or die(mysqli_error($select_query_result));
            $row= mysqli_fetch_array($select_query_result);
            $name=$row['first_name']." ".$row['last_name'];
          echo $name;
                                       
?>