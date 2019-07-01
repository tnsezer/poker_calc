<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 24.07.2018
 * Time: 20:40
 */
namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Util\Calculator;

class CalculatorTest extends TestCase
{
    public function testCalculate(){
        $result = Calculator::calculate(2, 1);

        $this->assertEquals(50, $result);
    }
}