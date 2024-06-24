<?php
include('inc/dbconnect.php');
session_start();
   $id = $_SESSION['id'];  

   $uid = $_GET['userId'];
   if(isset($_GET['userId'])){
    
    $qury = "SELECT * FROM users WHERE id = '$uid'";
       $result = mysqli_query($conn, $qury);
       $row=mysqli_fetch_array($result);
       $userId = $row['id'];

       $del = "DELETE FROM users WHERE id='$userId'";
       $redel = mysqli_query($conn, $del);

       if($redel){
        header('location: alibaba.php');
       }else{
        echo "Something Went Wrong".mysqli_error($conn);
       }
   }


?>