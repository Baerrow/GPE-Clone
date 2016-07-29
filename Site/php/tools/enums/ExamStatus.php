<?php

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 13:58
 */
abstract class ExamStatus
{
    const OPEN = 0;
    const CLOSED = 1;

    public static function ToString($status)
    {
        if ($status == ExamStatus::OPEN)
        {
            return "Ouvert";
        }
        else if ($status == ExamStatus::CLOSED)
        {
            return "Fermé";
        }
        else {
            throw new Exception("Unkown status: $status");
        }
    }
}