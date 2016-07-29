<?php

include_once('database/getDatabase.php');
include_once('php/tools/getFromArray.php');

const SQL_GET_EXAM = "SELECT * FROM exams";

const SQL_CREATE_EXAM =
    "INSERT INTO questions(id_exam, label, points, type, option1, option2, option3, option4, right_answer) VALUES (:id_exam, :label, :points, :type, :option1, :option2, :option3, :option4, :right_answer);";



$database = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $query = $database->prepare(SQL_CREATE_EXAM);

        $query->execute(array(
            ':id_exam' => $_POST['idExam'],
            ':label'   => $_POST['labelQuestion'],
            ':points'   => $_POST['points'],
            ':type'   => $_POST['typeResponse'],
            ':option1' => $_POST['option1'],
            ':option2' => $_POST['option2'],
            ':option3' => $_POST['option3'],
            ':option4' => $_POST['option4'],
            ':right_answer' => $_POST['right_answer']
        ));
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}

function getExams($database)
{
    $sql = $database->query(SQL_GET_EXAM);
    return $sql->fetchAll();
}
