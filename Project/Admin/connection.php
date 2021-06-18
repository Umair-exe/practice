<?php
$conn = mysqli_connect('localhost','root','','weblab');

if(!$conn) {
    die ("database connection failed! ". mysqli_connect_errno()); 
}
?>