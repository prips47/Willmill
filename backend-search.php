<?php
$con = mysqli_connect("localhost", "root", "", "newsfeed");
 if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
 }
 if(isset($_REQUEST['term'])){
    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE first_name LIKE ?";
    
    if($stmt = mysqli_prepare($con, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = '%'.$_REQUEST['term'] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["first_name"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($con);
?>