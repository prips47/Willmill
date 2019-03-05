 <?php
        $con=mysqli_connect("localhost","root","","newsfeed")
        or die(mysqli_error($con));
        session_start();
            $post_id=$_POST['data1'];
            $edit= mysqli_real_escape_string($con,$_POST['data2']);

          $update_query="update newsfeed.post SET texts='$edit' where id=$post_id";
          $update_query_result= mysqli_query($con, $update_query)
                  or die(mysqli_error($update_query_result));
          echo $update_query_result;
                                       
?>