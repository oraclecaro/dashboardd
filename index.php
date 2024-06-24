<?php
include('inc/dbconnect.php');
$usernameError = '';
$emailError = '';
$passwordError = '';
$pwd = '';
$msg = '';

if (isset($_POST['submit'])) {
    $errors = array();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = sha1($password);
    $cpassword = $_POST['cpassword'];
    $regdate = Date('Y-m-d h:m:i');

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    @$file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $file_nameNEW = time() . "." . $file_ext;
    $extensions = array("jpeg", "jpg", "png");



    
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    #checking empty fields
    if (empty($username)) {
        $usernameError = 'Username Required';
    } elseif (empty($email)) {
        $emailError = 'Email Required';
    } elseif (empty($password)) {
        $passwordError = 'Password Required';
    } elseif ($password != $cpassword) {
        $pwd = 'Password Not Match';
    } else {
        #checking duplicate from the Database
        $check_duplicate = "SELECT email FROM users WHERE email='$email'";
        $query = mysqli_query($conn, $check_duplicate);
        $count = mysqli_num_rows($query);
        if ($count != 0) {
            $msg = 'User Already Exist in our Database, Use another Email and Try Again!';
        } elseif (empty($errors) == true) {
            $upload =  move_uploaded_file($file_tmp, "upload/" . $file_nameNEW);
            #inserting record into database table
            $query = "INSERT INTO users(username,email,password,fileupload,regdate)VALUES('$username','$email', '$hashed_password', '$file_nameNEW', '$regdate')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $upload =  move_uploaded_file($file_tmp, "upload/" . $file_nameNEW);

                header('location: alibaba.php');
                echo "Data Uploaded Successfully";
            } else {
                echo "Something went wrong" . mysqli_error($conn);
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css" .css">
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

        form button {
            width: 250px;
            height: 50px;
            border-radius: 10px;
            margin-left: 5px;
            margin-top: 5px;
        }

        h1{
            color: rgba(113, 99, 186, 255);
        }
    </style>
</head>

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
    <div id='wrapper'>
        <form action="" method="post" enctype="multipart/form-data">
        <h1>Registration/SignUp</h1>
            <input type="text" name="username" placeholder="Enter your username"><br>
            <!-- <?php if (!empty($usernameError)) {
                        echo '<p class="error">' . $usernameError . '</p>';
                    } ?> -->
            <input type="email" name="email" placeholder="Enter your Email"></br>
            <!-- <?php if (!empty($emailError)) {
                        echo '<p class="error">' . $emailError . '</p>';
                    } ?> -->
            <input type="file" name="image" id=""><br>
            <input type="password" name="password" placeholder="Enter your Password"></br>
            <!-- <p><?php echo $passwordError; ?></p> -->
            <input type="password" name="cpassword" placeholder="Retype Password"></br>
            <!-- <p><?php echo $pwd; ?></p> -->
            <button type="submit" value="SignUp" name="submit">SignUP</button>
            <input type="submit" value="SignUp" name="submit">
        </form>
        <!-- <?php if (!empty($msg)) {
                    echo '<p class="error">' . $msg . '</p>';
                } ?> -->
    </div>
</body>

</html>