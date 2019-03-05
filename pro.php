<?php
session_start();
 if(isset($_SESSION['id']) && isset($_GET['action_id'])){
     $action_id=$_GET['action_id'];
     echo "$action_id";
 }
 else{
     header("Location: ./index.php");
 }
?>