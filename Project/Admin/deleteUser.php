<?php
session_id('session2');
session_start();
require "../connection.php";

if(isset($_GET['id'])) 
{
    $id=$_GET['id'];

    $query="DELETE FROM users where id='$id'";
    if(mysqli_query($conn,$query)) 
    {
        header('location:Users.php');
    }
    else
    { 
        echo "user not deleted!";
    
    }



}
?>