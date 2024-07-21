<?php

namespace AMTheme\Classes;

class Helpers
{
    /**
     * Function for debug anything
     *
     * Result for work function you can find on parent folder your theme in file `debug.log`.
     * 
     * @param  mixed $data
     * @return void
     */
    public static function debug($data)
    {
        $timestamp = date("Y-m-d H:i:s");
        $log = $timestamp . " - " . print_r($data, true) . "\n";
        error_log($log, 3, AMTHEME_PATH . "/debug.log");
    }
}
