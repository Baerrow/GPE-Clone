<?php

include ('database/getDatabase.php');

const SQL_STUDENT = 
    "SELECT users.id as student_id, users.firstname as fname, users.lastname as lname, classes.label as class, classes.id as class_id, students.status as status
    FROM users
    INNER JOIN students ON users.id = students.id_user
    INNER JOIN classes ON students.id_class = classes.id
    WHERE users.type = 0
    AND status = 0";

$database = getDatabase();

function getStudents($database){
    $sth = $database->query(SQL_STUDENT);

    return $sth->fetchAll();
}