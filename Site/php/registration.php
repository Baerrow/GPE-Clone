<?php

include_once('database/getDatabase.php');

const SQL_CREATE_USER =
"INSERT INTO users(firstname, lastname, type, password, email) VALUES (:firstname, :lastname, :type, :password, :email);";

const SQL_GET_CLASS = "SELECT * FROM classes;";
const SQL_GET_NEW_USER = "SELECT * FROM users WHERE email = :mail;";
const SQL_AFFECT_CLASS_TO_STUDENT = "INSERT INTO students(id_class, id_user) VALUES (:id_cl, :id_us);";

$database = getDatabase();

$sql = $database->query(SQL_GET_CLASS);
$class = $sql->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        
        $user = array(
            "firstname" => $_POST["firstName"],
            "lastname" => $_POST["lastName"],
            "type" => $_POST["role"] == "prof" ? 1 : 0,
            "password" => $_POST["password"],
            "email" => $_POST["email"],
        );

        $query = $database->prepare(SQL_CREATE_USER);

        $query->execute(array(
            ":firstname" => $user["firstname"],
            ":lastname" => $user["lastname"],
            ":type" => $user["type"],
            ":password" => $user["password"],
            ":email" => $user["email"],
        ));

        if (isset($_POST['class'])) {
            $sql = $database->prepare(SQL_GET_NEW_USER);
            $sql->execute(array(
                ":mail" => $user["email"]
            ));

            $us = $sql->fetch();
            $id_us = $us['id'];

            $sql = $database->prepare(SQL_AFFECT_CLASS_TO_STUDENT);
            $sql->execute(array(
                ":id_cl" => $_POST['class'],
                ":id_us" => $id_us
            ));
        }

        header('Location: login.php?msg-ok=Votre compte a été correctement créé.');
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}