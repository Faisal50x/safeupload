<?php
/**
 * #Author  @ Faisal Ahmed
 * #Date:   @ 1/14/19
 * #Phone:  @ 01788656451
 * #Email:  @ contact.faisalahmed@gmail.com
 * #Project Safe Upload File @ Utilities.php
 */

namespace Safe\System;


class Utilities implements \IUtilities
{
    public static function convertToBytes($val){
        $val = trim($val);
        $last = strtolower($val[strlen($val-1)]);
        if (in_array($last,array('g','m','k'))){
            switch ($last){
                case "g":
                    $val *= 1024;
                case "m":
                    $val *= 1024;
                case "k":
                    $val *= 1024;

            }
        }

        return $val;
    }

    public static function convertFromBytes($bytes){
        $bytes /= 1024;
        if ($bytes > 1024){
            return number_format($bytes/1024, 1) . ' MB';
        }else{
            return number_format($bytes, 1) . ' KB';
        }
    }
}