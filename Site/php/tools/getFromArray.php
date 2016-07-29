<?php
function getFromArray($array, $key)
{
    if (isset($array[$key]))
    {
        return htmlspecialchars($array[$key]);
    }
    else
    {
        return null;
    }
}