<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 25.07.2018
 * Time: 20:07
 */

namespace App\DependencyInjection;

use App\Util\Banner;
interface IStore
{
    public function set(Banner $banner);
    public function get(int $bannerID);
    public function getAll();
    public function deleteAll();
}