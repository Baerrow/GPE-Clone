<?php

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 25/05/16
 * Time: 10:03
 */
abstract class StudentStatus
{
    // USAGE : StudentStatus::WAITING
    const WAITING = 0;
    const VALIDATED = 1;

    public static function ToString($status)
    {
    	if ($status == StudentStatus::WAITING)
    	{
    		return "En attente";
    	}
    	else if ($status == StudentStatus::VALIDATED)
    	{
    		return "Validé";
    	}
    	else {
    		throw new Exception("Unkown status: $status");
    	}
    }

}