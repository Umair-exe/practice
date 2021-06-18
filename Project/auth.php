                <?php
                session_id('session1');
                session_start();
                require("connection.php");


                if($stmt=$conn->prepare('SELECT id,password,fname,lname,imagename,loginAttempts from users where username=?')){
                    $stmt->bind_param('s',$_POST['username']);
                    $stmt->execute();
                    $stmt->store_result();


                    if($stmt->num_rows > 0) {
                        $stmt->bind_result($id,$password,$fname,$lname,$imagename,$loginAttempts);
                        $stmt->fetch();

                        if($loginAttempts >= 4) {
                            header('location:index.php?message=userlocked!');
                        }
                        else {
                                
                            if($_POST['password']==$password)
                            {
                                $query="UPDATE users SET loginAttempts=0 where id='$id'";
                                $exec=mysqli_query($conn,$query);
                             
                                
                                $_SESSION['loggedIn']=true;
                                $_SESSION['username']=$_POST['username'];
                                $_SESSION['id']=$id;
                                $_SESSION['password']=$password;
                                $_SESSION['name']=$fname. " " . $lname;
                                $_SESSION['imagename']=$imagename;

                                header("location:home.php");
                                
                                }
                            else{
                                $query="UPDATE users SET loginAttempts='$loginAttempts'+1 where id='$id'";
                                $exec=mysqli_query($conn,$query);
                                header("location:index.php?message=incorrect Password!");
                            }
                        } 
                    }
                    else {
                        header("location:index.php?message=incorrect username!");
                        }
                    }
                else {
                    echo mysqli_errno($conn);
                }
                            
    ?>