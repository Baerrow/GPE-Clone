<?php

include_once('database/getDatabase.php');
include_once('php/tools/enums/ExamStatus.php');

const SQL_GET_EXAM = "SELECT * FROM exams WHERE id = :id;";

const SQL_GET_CLASSES = "SELECT * FROM classes;";
const SQL_GET_SUBJECTS = "SELECT * FROM subjects;";

const SQL_EDIT_EXAM =
"UPDATE exams SET id_subject = :id_subject, id_class = :id_class, label = :label, status = :status WHERE id = :id;";

$database = getDatabase();

$id_exam = (int)$_REQUEST['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $exam = array(
            'id' => $id_exam,
            'label' => $_POST['nameExam'],
            'id_subject' => $_POST['subjectExam'],
            'id_class' => $_POST['classExam'],
            'status' => $_POST['status'],
        );

        $query = $database->prepare(SQL_EDIT_EXAM);

        $query->execute(array(
            ':id' => $exam['id'],
            ':label' => $exam['label'],
            ':id_subject' => $exam['id_subject'],
            ':id_class' => $exam['id_class'],
            ':status' => $exam['status'],
        ));

        header("Location: editExam.php?id=$id_exam&msg-ok=Le partiel a bien été modifié.");
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}

function getExam($database, $id)
{
    $sth = $database->prepare(SQL_GET_EXAM);
    $sth->execute(array(":id" => $id));

    return $sth->fetch();
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