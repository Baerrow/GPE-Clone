<?php

include_once('../database/getDatabase.php');

const SQL_UPDATE_STUDENT =
"UPDATE students SET status = 1 WHERE id_user = :id_user;";

$database = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        $sth = $database->prepare(SQL_UPDATE_STUDENT);

        $sth->bindParam(":id_user", $_POST['student_id'], PDO::PARAM_INT);

        $sth->execute();

        header('Location: ../listStudent.php?msg-ok=L étudiant a été validé !');
    }
    catch (Exception $e)
    {
        var_dump($e);
    }
}