<?php
//src/lib/logout.php
session_start();
session_unset();
session_destroy();

    header('location:../templates/login_form.php');
    
?>