<?php

    if(isset($_SESSION['username']))
    {
        if((time() - $_SESSION['last_login_timestamp']) > 1800)
        {
            header("Location: logout.php");
        }
        else
        {
            $_SESSION['last_login_timestamp'] = time();
        }
    }
    else
    {
        header("Location: login.php");
    }
    session_abort();
?>