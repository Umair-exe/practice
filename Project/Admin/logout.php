<?php
session_id('session2');
session_start();
session_destroy();

header('location:login.php?message=loggedOut!');

?>