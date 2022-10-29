<?php


function isNumericExceptionCheck($n)
{
    if (!is_numeric($n)) {
        throw new TypeError();
    }
}
