<?php

include_once('database/getDatabase.php');
include_once('php/tools/getFromArray.php');

const SQL_GET_CLASSES = "SELECT * FROM classes;";
const SQL_GET_SUBJECTS = "SELECT * FROM subjects;";

const SQL_CREATE_EXAM =
    "INSERT INTO exams(id_subject, id_class, id_user, label, status) VALUES (:id_subject, :id_class, :id_user, :label, 0);";

$database = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $exam = array(
            'label' => $_POST['nameExam'],
            'id_subject' => $_POST['subjectExam'],
            'id_class' => $_POST['classExam']
        );

        $query = $database->prepare(SQL_CREATE_EXAM);

        $query->execute(array(
            ":id_subject" => $exam["id_subject"],
            ":id_class" => $exam["id_class"],
            ":id_user" => $_SESSION["id_user"],
            ":label" => $exam["label"]
        ));

        header('Location: listExam.php?msg-ok=Le partiel a été créé !');
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}

function getClasses($database)
{
    $sth = $database->query(SQL_GET_CLASSES);

    return $sth->fetchAll();
}

function getSubjects($database)
{
    $sth = $database->query(SQL_GET_SUBJECTS);

    return $sth->fetchAll();
}