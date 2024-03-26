<?php
//File to log out the user from the session that was created.
//Resets all the variables and destroys them.
session_start();
session_unset();
session_destroy();
header("location: ../index.php");
exit();