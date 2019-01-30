<?php
	$sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $connection->exec($sql);

    $sql = "USE camagru";
    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS userinfo (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username varchar(100) NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        verified INT
    )";

    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS userimage (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user varchar(100) NOT NULL,
        img longtext NOT NULL,
        likes INT NOT NULL,
        comments varchar(255)
    )";

    $connection->exec($sql);
    
?>