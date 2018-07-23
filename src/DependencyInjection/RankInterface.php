<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 24.07.2018
 * Time: 00:46
 */

namespace App\DependencyInjection;


interface RankInterface
{
    public function get();
    public function set(string $name);
}