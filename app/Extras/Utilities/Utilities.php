<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 2/7/2018
 * Time: 12:28 PM
 */

namespace App\Extras\Utilities;


class Utilities
{
    public static function flatArrayKeys($array, $separator = '.')
    {
        $keys = array_keys($array);
        $string = '';
        foreach ($keys as $index => $key) {
            $string .= $key;
            if ($index != count($keys) - 1) {
                $string .= $separator;
            }
        }
        return $string;
    }

    public static function flatArrayValues($array , $separator = '.'){
        $string = '';
        foreach ($array as $index => $item){
            $string .= $item;
            if ($index != count($array) - 1) {
                $string .= $separator;
            }
        }
        return $string;
    }


}