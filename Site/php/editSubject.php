<?php

include_once('database/getDatabase.php');
include_once('php/tools/getFromArray.php');
include_once('php/tools/s_echo.php');

$id = $_REQUEST['id'];

const SQL_GET_CLASSES = "SELECT * FROM classes;";
const SQL_EDIT_SUBJECT = "UPDATE subjects SET label = :label, id_class = :id_class WHERE id = :id;";
const SQL_GET_SUBJECT = "SELECT * FROM subjects WHERE id = :id;";

$database = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $subject = array(
            'label' => $_POST['nameSubject'],
            'id_class' => $_POST['classSubject']
        );

        $query = $database->prepare(SQL_EDIT_SUBJECT);

        $query->execute(array(
            ":label" => $subject["label"],
            ":id_class" => $subject["id_class"],
            ":id" => $id
        ));

        header('Location: listSubject.php');
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}

function editSubject($database, $id, $label, $id_class)
{
    $sth = $database->prepare(SQL_EDIT_SUBJECT);
    $sth->execute(array(":id" => $id, ":label" => $label, ":id_class" => $id_class));
    return $sth->fetch();  
    
}

function getSubject($database, $id) {
    $sth = $database->prepare(SQL_GET_SUBJECT);
    $sth->execute(array(":id" => $id));
    return $sth->fetch();
}

function getClasses($database)
{
    $sth = $database->query(SQL_GET_CLASSES);

    return $sth->fetchAll();
}