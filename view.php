<?php
    include('inc/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Records</title>
</head>
<body>
    <?php
        $user_id = $_GET['Id'];
        $qury = "SELECT * FROM users WHERE id = '$user_id' ";
        $result = mysqli_query($conn,$qury);
        while($row=mysqli_fetch_array($result)){
            echo $row['username'].'<br>';
            echo $row['email']."<br>";

            ?>
<img src="upload/<?php echo $row['fileupload']; ?>" width="300" alt="">
    <?php

        }

    ?>
</body>
</html>