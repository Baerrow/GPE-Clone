<?php

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 13:55
 */
abstract class UserType
{
    // USAGE : UserType::STUDENT
    const STUDENT = 0;
    const PROFESSOR = 1;

    public static function ToString($type)
    {
        if ($type == UserType::STUDENT)
        {
            return "Elève";
        }
        else if ($type == UserType::PROFESSOR)
        {
            return "Professeur";
        }
        else {
            throw new Exception("Unkown type: $type");
        }
    }
}