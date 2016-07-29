<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 09:49
 */

function getDatabase()
{
    $database_url = "localhost";
    $database_port = "3306";
    $database_name = "gpe";
    $database_login = "root";
    $database_password = "";


    return new PDO("mysql:host=$database_url;port=$database_port;dbname=$database_name;charset=utf8",
        $database_login,
        $database_password,
        array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
}
