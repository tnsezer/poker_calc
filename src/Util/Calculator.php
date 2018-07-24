<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 24.07.2018
 * Time: 20:40
 */
namespace App\Util;

class Calculator
{
    /**
     * @param int $total
     * @param int $howMany
     * @return float
     */
    public static function calculate(int $total, int $howMany){
        $chance = ($howMany / $total) * 100;

        return round($chance, 2);
    }
}