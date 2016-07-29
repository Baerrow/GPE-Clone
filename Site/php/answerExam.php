<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 14:18
 */

include_once("php/tools/s_echo.php");
include_once("php/tools/enums/QuestionType.php");
include_once("database/getDatabase.php");

const SQL_GET_EXAM = "SELECT * FROM exams WHERE id = :id;";
const SQL_GET_QUESTIONS = "SELECT * FROM questions WHERE id_exam = :id_exam;";

const SQL_ADD_ANSWER =
    "INSERT INTO answers(id_question, id_user, user_choice) VALUES (:id_question, :id_user, :user_choice);";

const SQL_ADD_MARK =
"INSERT INTO marks(id_user, id_exam, mark) VALUES (:id_user, :id_exam, :mark);";

$database = getDatabase();

$exam_id = (int)$_REQUEST["id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $questions = getQuestions($database, $exam_id);

        $user_answers = $_POST["answers"];

        $mark = 0;

        $addAnswerStatement = $database->prepare(SQL_ADD_ANSWER);

        foreach ($questions as $question)
        {
            $user_answer = $user_answers[$question["id"]];

            if($question['type'] == QuestionType::CHOICE)
            {
                $user_answer = $question['option'.$user_answer];
            }

            if (strtolower(trim($user_answer)) == strtolower(trim($question['right_answer'])))
            {
                $mark += $question["points"];
            }

            $addAnswerStatement->execute(array(
                ":id_question" => $question['id'],
                ":id_user" => $_SESSION["id_user"],
                ":user_choice" => $user_answer,
            ));
        }

        $addMarkStatement = $database->prepare(SQL_ADD_MARK);
        $addMarkStatement->execute(array(
            ":id_user" => $_SESSION["id_user"],
            ":id_exam" => $exam_id,
            ":mark" => $mark
        ));

        header("Location: showCorrection.php?msg-ok=Votre partiel a été validé !&id_exam=".$exam_id);
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}

function getExam($database, $exam_id)
{
    $sth = $database->prepare(SQL_GET_EXAM);
    $sth->execute(array(":id" => $exam_id));

    return $sth->fetch();
}

function getQuestions($database, $exam_id)
{
    $sth = $database->prepare(SQL_GET_QUESTIONS);
    $sth->execute(array(":id_exam" => $exam_id));

    return $sth->fetchAll();
}
