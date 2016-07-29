<?php

function isTeacherBySession() {
    return ($_SESSION['role'] == UserType::PROFESSOR) ? true : false;
}

function isTeacherByUser($user) {
    return ($user['type'] == UserType::PROFESSOR) ? true : false;
}

function isValidStudentBySession($user) {
    // if($_SESSION['role'] == UserType::STUDENT && $_SESSION['is_valid'] == 1)
    if($_SESSION['role'] == UserType::STUDENT)
        return true;
    else
        return false;
}

function isValidStudentByUser($user) {
    // if($user['type'] == UserType::STUDENT && $user['is_valid'] == 1)
    if($user['type'] == UserType::STUDENT)
        return true;
    else
        return false;
}
