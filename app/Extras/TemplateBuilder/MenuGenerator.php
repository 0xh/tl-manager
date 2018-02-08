<?php

namespace App\Extras\TemplateBuilder;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class MenuGenerator
{
//    public $menu;
    public $controller;
    public $parsed_array = [];


    public static function checkForInfo($class)
    {
        $info = [
            'icon' => 'zmdi-landscape'
        ];
        if (method_exists($class, 'getInfo')) {
            $n = $class::getInfo();
            foreach ($n as $key => $value) {
                $info[$key] = $value;
            }
        }

        return $info;
    }
    public static function getMenuFromRoute($base = 'dashboard')
    {
        /*
         * an array of all routes
         * TODO: Cash it all
         */
        $routes = Route::getRoutesList()->all();
        /*
         * needed routes
         */
        $filtered_routes = [];
        foreach ($routes as $route) {
            if ($route['method'] == 'GET|HEAD' && str_contains($route['uri'], $base) && str_contains($route['name'], 'index')) {
                $filtered_routes[] = $route;
            }
        }
        if (empty($filtered_routes)) {
            return false;
        }
        /*
         * menu will have three levels
         *
         * level 0 - parent
         *      this levels will only have one forward slash (/)
         *      and the count will be 2
         * level 1 - parent & child
         *      this levels will have tow forward slash (/)
         *      and the count will be 3
         * level 2 - child
         *      this levels will have three forward slash (/)
         *      and the count will be 4
         */
        $menu = [];
        foreach ($filtered_routes as $filtered_route) {
            $exploded = explode('/', $filtered_route['uri']);
            $action = explode('@', $filtered_route['action']);
            switch (count($exploded)) {
                case 2: # level 0
                case 3: # level 1
                case 4: # level 2
                    $menu[\App\Extras\Utilities\Utilities::flatArrayValues($exploded)] = $action[0];
                    break;
            }
        }
        asort($menu , ARRAY_FILTER_USE_KEY);
        return $menu;
    }

}
