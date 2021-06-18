<?php
session_id('session2');
session_start();
require '../connection.php';
if (!isset($_SESSION['loggedIn1'])) {
    header('location:login.php?message=loginFirst!');
}

$query = "SELECT * from users";
$fetch = mysqli_query($conn, $query);

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
            background-color: #3d3d3d;
            color: white;
            padding: 20px 40px;
            text-align: center;


        }

        .right {
            flex: 75%;
            background-color: antiquewhite;
            box-shadow: 0 4px 8px 0 white, 0 6px 20px 0 white;

        }

        .nav {
            display: flex;
            justify-content: space-between;
            background-color: #3d3d3d;
            padding: 20px 40px;
            top: 0;
            position: sticky;
        }
        #search {
            width: 350px;
            height: 30px;
            border: 1px solid #3d3d3d;
            border-radius: 5px;
            
        }
      
        .links {
            background-color: transparent;
            color: white;
            padding: 10px;
            width: 100%;
        }

        .links:hover {
            background-color: white;
            color: black;
        }

        a {
            color: white;
        }

        .hover:hover {
            background-color: #3d3d3d;
            opacity: 1;
        }

        .search {
            display: flex;
            justify-content: center;
        }

        .sea {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>

    <div class="row">
        <div class="left">
            <h1>Dashboard</h1>

            <div style="margin-top: 30px;" class="links">

                <a href="Users.php">Users</a><br>
            </div>
            <div style="margin-top: 15px;" class="links">
                <a href="dashboard.php">Home</a>
            </div>
        </div>
        <div class="right">
            <div class="nav ">
                <h3 style="color:white">Logo</h3>
                <a class="btn btn-primary" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
<br><br>
            <div class="container">
                <div class="sea">
                    <div>
                        <h3>Users</h3>
                    </div>
                    <div class="search">
                        <form action="">
                            <label for="search">Enter username to search
                                <input type="text" name="search" autocomplete="off" id="search" onkeyup="searchUser(this.value)" />
                            </label>
                        </form>
                    </div>
                 
                </div>
                <div class="container"  style="text-align: center;" id="showUser"></div><br>
        
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Login Attempts</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($res = mysqli_fetch_array($fetch)) {  ?>
                        <tr style="color: white;" class="hover">
                            <td><?php echo $res['id'] ?></td>
                            <td><?php echo $res['username'] ?></td>
                            <td><?php echo $res['password'] ?></td>
                            <td><?php echo $res['email'] ?></td>
                            <td><?php echo $res['fname'] . " " . $res['lname'] ?></td>
                            <td><?php echo $res['loginAttempts'] ?></td>
                            <td><a class="btn btn-warning" href="editUser.php?id=<?php echo $res['id'] ?>">Edit</a> | <a class="btn btn-danger" onclick="deleteUser(<?php echo $res['id'] ?>)">Delete</a> </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</body>

</html>


<script>
    function deleteUser(value) {

        if (confirm('Your sure want to delete the user?')) {

            window.location.href = "deleteUser.php?id=" + value;
        } else {
            alert("user not deleted!");
        }
    }

    function searchUser(str) {
        if (str.length == 0) {

            document.getElementById('showUser').innerHTML = '';
            return;
        } 
        else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('showUser').innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "getUser.php?q=" + str, "true");
            xmlhttp.send();
        }
    }
</script>