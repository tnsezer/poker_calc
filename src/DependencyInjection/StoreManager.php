<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 25.07.2018
 * Time: 20:10
 */

namespace App\DependencyInjection;


class StoreManager
{
    private $bridge;

    public function __construct(IStore $store)
    {
        $this->bridge = $store;
    }
}