<?php
session_id('session2');
session_start();
require("connection.php");


if ($stmt = $conn->prepare('SELECT id,username,password,loginAttempts from admin where username=?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $password, $loginAttempts);
        $stmt->fetch();

        if ($loginAttempts >= 4) {
            header('location:login.php?message=userlocked!');
        } else {

            if ($_POST['password'] == $password) {
                $query = "UPDATE admin SET loginAttempts=0 where id='$id'";
                $exec = mysqli_query($conn, $query);

              
                $_SESSION['loggedIn1'] = true;
                $_SESSION['username1'] = $_POST['username'];
                $_SESSION['id1'] = $id;
                $_SESSION['password1'] = $password;
                header("location:dashboard.php");
            } else {
                $query = "UPDATE admin SET loginAttempts='$loginAttempts'+1 where id='$id'";
                $exec = mysqli_query($conn, $query);
                header("location:login.php?message=incorrect Password!");
            }
        }
    } else {
        header("location:login.php?message=incorrect username!");
    }
} else {
    echo mysqli_errno($conn);
}

?>