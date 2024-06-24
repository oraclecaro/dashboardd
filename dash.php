<?php
include('inc/dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="dash.css">
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
            <li class="logout">
                <a href="autho.php?user=1">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span>Primary</span>
                <h2>Dashboard: <?php
                                include('inc/dbconnect.php');
                                session_start();
                                echo 'Welcome Back ' . $_SESSION['username'];
                                ?></h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="search" />
                </div>
                <img src="/images/vecteezy_3d-rendering-humanoid-robot-thinking-on-white-background_23042188_229.jpg"
                    alt="">
            </div>
        </div>
        <div class="card--container">
            <h3 class="main--title">Today's data</h3>
            <div class="card--wrapper">
                <div class="payment--card light-red">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Payment amount</span>
                            <span class="amount--value">$500.00</span>
                        </div>
                        <i class="fas fa-dollar-sign icon"></i>
                    </div>
                    <span class="card-detail">**** **** **** 3484</span>
                </div>

                <div class="payment--card light-purple">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Payment order</span>
                            <span class="amount--value">$200.00</span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">**** **** **** 5584</span>
                </div>

                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Payment Customer</span>
                            <span class="amount--value">$350.00</span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card-detail">**** **** **** 5584</span>
                </div>

                <div class="payment--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">Payment order</span>
                            <span class="amount--value">$200.00</span>
                        </div>
                        <i class="fas fa-check icon dark-blue"></i>
                    </div>
                    <span class="card-detail">**** **** **** 5584</span>
                </div>
            </div>
        </div>

        <div class="tabular--wrapper">
            <h3 class="main--title">Signup data</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>S/N</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>


                    <?php
                    $sn = "";
                    // to show the last 5 records from the database
                    $query = "SELECT * FROM users order by id DESC LIMIT 5";

                    // to show the first 5 records from the database
                    // $query = "SELECT * FROM users order by id ASC LIMIT 5";
                    $res = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($res)) {
                        $sn++;
                        $username = $row['username'];
                        $email = $row['email'];
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td>
                                    <button><a href='view.php?Id=<?php echo $row['id']; ?>'>View</a></button>
                                    <button><a href="edit.php?uid=<?php echo $row['id'];?>">Edit</a></button>
                                    <button>Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>