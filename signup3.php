<?php

    $email = $_GET['email'];
    require_once "config/setup.php";
    $sql=$connection->prepare("update `userinfo` set verified=1 where email='$email'");
    $sql->execute();
    
    header("Location:camera3.php");
?>