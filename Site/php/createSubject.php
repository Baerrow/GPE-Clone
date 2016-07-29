<?php

include_once('database/getDatabase.php');
include_once('php/tools/getFromArray.php');

const SQL_GET_CLASSES = "SELECT * FROM classes";

const SQL_CREATE_SUBJECT =
    "INSERT INTO subjects(label, id_class) VALUES (:label, :id_class);";

$database = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $subject = array(
            'label' => $_POST['nameSubject'],
             'id_class' => $_POST['classSubject']
        );

        $query = $database->prepare(SQL_CREATE_SUBJECT);

        $query->execute(array(
            ":label" => $subject["label"],
            ":id_class" => $subject["id_class"]
        ));

        header('Location: listSubject.php?msg-ok=La matière a été correctement créée !');
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}


function getClass($database)
{
    $sql = $database->query(SQL_GET_CLASSES);
    return $sql->fetchAll();
}
