<?php
session_start();
if(isset($_SESSION['id'])) header('Location: ./index.php');
?>
<html>
<head><title>Login</title></head>
<body>
  <?php
  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $con= new mysqli("localhost","root","","newsfeed")
            or die($con->connect_error);
    echo $email.$pass;
    $res = $con->query("SELECT * FROM users WHERE email = '$email' AND pass = '$pass';");
    if($res->num_rows == 1){
      while($row = $res->fetch_assoc()){
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_data'] = $row;
        header('Location: ./index.php');
      }
    }
  }
  ?>
  <form action = "<?php echo $_SERVER['PHP_SELF']?>" method = "POST">
    <input type = "text" name = "email"/>
    <input type = "text" name = "password"/>
    <input type = "submit" name = "submit" value = "Login"/>
  </form>
