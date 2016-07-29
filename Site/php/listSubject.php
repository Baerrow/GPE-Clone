<?php

/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 24/05/16
 * Time: 12:44
 */
include_once ('database/getDatabase.php');
include_once ('php/tools/s_echo.php');

        const SQL_GET_SUBJECTS = "SELECT subjects.label labelSubject, subjects.id idSubject, subjects.id_class, classes.label labelClass 
                FROM subjects
                INNER JOIN classes ON subjects.id_class = classes.id";

$database = getDatabase();

function getSubjects($database) {
    $sth = $database->query(SQL_GET_SUBJECTS);

    return $sth->fetchAll();
}
