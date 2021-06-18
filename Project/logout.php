<?php
session_id('session1');
session_start();
session_destroy();

header("location:index.php?message=loggedout");
?>