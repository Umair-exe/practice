<?php
session_id('session2');
session_start();
require '../connection.php';


if(!isset($_SESSION['loggedIn1'])) {
    header('location:login.php?message=loginFirst!');
}

$username=$_GET['q'];

$query = "SELECT * From users where username='$username'";
$exec = mysqli_query($conn,$query);
$fetch = mysqli_fetch_array($exec);

if($fetch['username']!= $username) {
    echo '<h3 style= "color:red;">' . "User Don't exist!" . '</h3>';
}
else
{
    echo '<span>Record Found!!!</span><br>';
    echo '<table class="table table-dark table-hover">
        <tr>
           <th>ID</th>
           <th>Username</th>
           <th>Password</th>
           <th>Email</th>
           <th>Name</th>
           <th>Login Attempts</th>
           <th>Action</th>
           
        </tr>
        <tr>
           <td>'. $fetch['id'] . '</td>
           <td>'. $fetch['username'] . '</td>
           <td>'. $fetch['password'] . '</td>
           <td>'. $fetch['email'] . '</td>
           <td>'. $fetch['fname'] ." " .$fetch['lname'] . '</td>
           <td>'. $fetch['loginAttempts'] . '</td>
           <td> <a class="btn btn-warning" href="editUser.php?id='.$fetch['id'].'" >Edit</a> | 
           <a class="btn btn-danger" href="deleteUser.php?id='.$fetch['id'].'" >Delete</a></td>
         
        </tr>

           </table>';
}
