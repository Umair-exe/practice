<?php
session_id('session2');
session_start();
require "connection.php";

if (!isset($_SESSION['loggedIn1'])) {
    header('location:login.php?message=loginFirst!');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .row {
            display: flex;
            height: 1080px;
        }

        .left {
            flex: 25%;
            background-color:#3d3d3d;
            color: white;
            padding: 20px 40px;
            text-align: center;
     

        }

        .right {
            flex: 75%;
            background-color: antiquewhite;
            box-shadow:  0 4px 8px 0 white, 0 6px 20px 0 white; 

        }

        .nav {
            display: flex;
            justify-content: space-between;
            background-color: #3d3d3d;
            padding: 20px 40px;
            top: 0;
            position: sticky;
        }
        .links {
            background-color: transparent;
            color : white;
            padding: 10px;
            width: 100%;
        }
        .links:hover {
            background-color: white;
            color:black;
        }
      
    </style>
</head>

<body>

    <div class="row">
        <div class="left">
            <h1>Dashboard</h1>

            <div style="margin-top: 30px;" class="links">
                <a href="Users.php" >Users</a>
            </div>
        </div>
        <div class="right">
            <div class="nav ">
                <h3 style="color:white">Logo</h3>
                <a class="btn btn-primary" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
    </div>
</body>

</html>