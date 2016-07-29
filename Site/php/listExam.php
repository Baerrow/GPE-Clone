<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 12:44
 */

include_once('tools/enums/ExamStatus.php');
include_once('database/getDatabase.php');

const SQL_STUDENT = "SELECT exams.id as idExams, exams.label as labelExams, status, id_subject, id_user, subjects.label as labelSubject, classes.label labelClass, users.firstname userFirstname, users.lastname userLastname
            FROM exams
            INNER JOIN subjects ON exams.id_subject = subjects.id
            INNER JOIN classes ON exams.id_class = classes.id
            INNER JOIN users ON exams.id_user = users.id
            WHERE exams.id_class = ?";

const SQL_PROF = "SELECT exams.id as idExams, exams.label as labelExams, status, id_subject, exams.id_class, id_user, subjects.label as labelSubject, classes.label labelClass, users.firstname userFirstname, users.lastname userLastname
            FROM exams
            INNER JOIN subjects ON exams.id_subject = subjects.id
            INNER JOIN classes ON exams.id_class = classes.id
            INNER JOIN users ON exams.id_user = users.id";

$database = getDatabase();

function getExams($database){
    if(isset($_SESSION['class'])) {
        $sth = $database->prepare(SQL_STUDENT);
        $sth->execute(array($_SESSION['class']));
    } else {
        $sth = $database->query(SQL_PROF);
    }

    return $sth->fetchAll();
}
