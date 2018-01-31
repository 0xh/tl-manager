<?php
/**
 * Created by PhpStorm.
 * User: husseinmirzaki
 * Date: 1/30/2018
 * Time: 10:50 PM
 */

namespace App\Exteras\Utilities;


use Illuminate\Support\Arr;

class Parsers
{

    public static function parse_args($array , $default)
    {
        dd(array_intersect(['test'=> [
            'ap' => 's' ,
            'dp' => 'd'
        ]] , ['test' => [
            'ap' => 's' ,
            'dp' => 's'
        ]]));
    }
    public static function test(){
        $s  = ['a'];
        dd($s['d']?:'a');
    }
}