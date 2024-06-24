<?php include('inc/dbconnect.php'); 
session_start();
    if(isset($_POST['login'])){
        $userEmail = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = SHA1($password);

        $query = "SELECT * FROM users WHERE email='$userEmail' AND password = '$hashed_password'";
        $result = mysqli_query($conn,$query);
        #check for an existing record from the Database

        $countUser = mysqli_num_rows($result);
        if($countUser !=0){
           $row=mysqli_fetch_array($result);
           $_SESSION['id'] = $row['id'];
           $_SESSION['email'] = $row['email'];
           $_SESSION['username'] = $row['username'];

           header('location: dash.php');

           
        }else{
            echo 'Authentication Failed'.MYSQLI_error($conn);
        }


    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn Form</title>
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css" .css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        border: none;
        outline: none;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }

    body {
        display: flex;
    }

    .sidebar {
        position: sticky;
        top: 0;
        left: 0;
        bottom: 0px;
        width: 110px;
        height: 100vh;
        padding: 0 1.7rem;
        color: #fff;
        overflow: hidden;
        transition: all 0.5s linear;
        background: rgba(113, 99, 186, 255);
    }

    .sidebar:hover {
        width: 240px;
        transition: 0.5s;
    }

    .logo {
        height: 80px;
        padding: 16px;
    }

    .menu {
        height: 88%;
        position: relative;
        list-style: none;
        padding: 0;
    }

    .menu li {
        padding: 1rem;
        margin: 8px 0;
        border-radius: 8px;
        transition: all 0.5s ease-in-out;
    }

    .menu li:hover,
    .active {
        background: #e0e0e058;
    }

    .menu a {
        color: #fff;
        font-size: 14px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .menu a span {
        overflow: hidden;
    }

    .menu a i {
        font-size: 1.2rem;
    }

    .logout {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
    }

    form {
        padding: 50px;
    }

    form h1 {
        color: rgba(113, 99, 186, 255);
    }

    form input {
        color: rgba(113, 99, 186, 255);
        border: rgba(113, 99, 186, 255) 0px solid;
        border-radius: 10px;
        width: 250px;
        height: 50px;
        margin: 5px;
        background-color: buttonface;
        padding: 10px
    }

    form button{
        width: 250px;
        height: 50px;
        border-radius: 10px;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistics</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-briefcase"></i>
                    <span>Careers</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-star"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <!-- <li class="logout">
                <a href="autho.php?user=1">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li> -->
        </ul>
    </div>

    <form action="" method="post">
        <h1>LogIn</h1>
        <input type="email" name="email" placeholder="Email Address" id=""><br>
        <input type="password" name="password" placeholder="Password" id=""><br>
        <input type="submit" name="login" value="LogIn"><br>
        <center>or</center> <br>
        <button><a href="index.php">Register Now!</a></button>    
    </form>

</body>

</html>