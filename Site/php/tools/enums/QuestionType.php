<?php

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/05/16
 * Time: 14:01
 */
abstract class QuestionType
{
    const TEXT = 0;
    const CHOICE = 1;

    public static function ToString($type)
    {
        if ($type == QuestionType::TEXT)
        {
            return "Texte libre";
        }
        else if ($type == QuestionType::CHOICE)
        {
            return "QCM";
        }
        else {
            throw new Exception("Unkown type: $type");
        }
    }
}