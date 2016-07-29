<?php

include ('database/getDatabase.php');

const SQL_CHECK_IF_EXAM_DONE = "SELECT * FROM marks WHERE id_user = :id_user AND id_exam = :id_exam";
const SQL_GET_EXAM = "SELECT exams.id as id_exams, exams.label as label_exams, status, exams.id_class, id_subject, id_user, subjects.label as label_subject, classes.label as label_class, users.firstname as user_firstname, users.lastname as user_lastname
            FROM exams
            INNER JOIN subjects ON exams.id_subject = subjects.id
            INNER JOIN classes ON exams.id_class = classes.id
            INNER JOIN users ON exams.id_user = users.id
            WHERE exams.id = :id_exam";
const SQL_GET_ANSWERS_BY_EXAM_USER = "SELECT questions.*, answers.* FROM questions
            LEFT Join answers ON answers.id_question = questions.id AND answers.id_user = :id_user
            WHERE questions.id_exam = :id_exam";
const SQL_GET_QUESTIONS_BY_EXAM = "SELECT * FROM questions WHERE id_exam = :id_exam";

$database = getDatabase();

function getExam($database)
{
    $sth = $database->prepare(SQL_GET_EXAM);
    $sth->execute(array(
        ':id_exam' => $_GET['id_exam']
    ));

    return $sth->fetchAll()[0];
}

function getQuestionsByExam($database)
{
    $sth = $database->prepare(SQL_GET_QUESTIONS_BY_EXAM);
    $sth->execute(array(
        ':id_exam' => $_GET['id_exam']
    ));

    return $sth->fetchAll();
}

function getAnswersByExam($database)
{
    $sth = $database->prepare(SQL_GET_ANSWERS_BY_EXAM_USER);
    $sth->execute(array(
        ':id_exam' => $_GET['id_exam'],
        ':id_user' => $_SESSION['id_user']
    ));

    return $sth->fetchAll();
}

function IsExamDone($database)
{
    $sth = $database->prepare(SQL_CHECK_IF_EXAM_DONE);
    $sth->execute(array(
        ':id_exam' => $_GET['id_exam'],
        ':id_user' => $_SESSION['id_user']
    ));
    $result = $sth->fetchAll(); 

    // We need to create the variable bellow to use empty function.
    return !empty($result);
}

try
{
    if (!IsExamDone($database))
        header('Location: listExam.php?msg-error=Vous n\'avez pas encore répondu à ce partiel !');

    $exam       = getExam($database);
    $questions  = getAnswersByExam($database);
}
catch (Exception $e)
{
    var_dump($e);
}