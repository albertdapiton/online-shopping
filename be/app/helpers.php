<?php

if (!function_exists('getClassConstants'))
{
    function getClassConstants($class)
    {
        try {
            $obj = new ReflectionClass($class);
            return $obj->getConstants();
        } catch (\Exception $ex) {
            \Log::error(__METHOD__ . '@' . $ex->getLine() . ': Target class [' . $clas . '] does not exist.');
        }
    }
}