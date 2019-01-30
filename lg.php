<?php
    require_once "config/setup.php";
    session_start();
    if(isset($_SESSION['id']))
    {
        header("Location:camera3.php");
    }
    else
    {
        echo "NOT logged in! <br> ";
        echo "<a href='index.php'>BACK</a>";
    }
?>