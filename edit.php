<?php
include('inc/dbconnect.php');
session_start();
 $id = $_SESSION['id'];

 $uid = $_GET['uid'];
 if(isset($_GET['uid'])){

    $qury = "SELECT * FROM user WHERE id = '$uid'";
    $result = mysqli_query($conn, $qury);
    $row = mysqli_fetch_array($result);
    $useId =$row['id'];
 }


    if(isset($_POST['update'])){
        $username = $_POST['username'];
        $email = $_POST['email'];

        $update = "UPDATE users SET Username='$username', Email = '$email' WHERE id='$userId' ";
        $res = mysqli_query($conn, $update);
        if($res){
            echo 'Record Updated Successfully';
            header("location: alibaba.php");
        }else{
            echo "Something Went Wrong".mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" value='<?php echo $row['username']; ?>' placeholder="Enter Username">
        <input type="Email" name="email" placeholder= "Enter Email Address" value='<?php echo $row['Email']; ?>'>
        <input type="Submit" name="update" value= "Update Now">
    </form>
</body>
</html>

<?php

?>