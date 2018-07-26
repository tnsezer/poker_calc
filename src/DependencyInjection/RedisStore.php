<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 25.07.2018
 * Time: 20:08
 */

namespace App\DependencyInjection;

use App\Util\Banner;
use Redis;
class RedisStore implements IStore
{
    private $key = 'banner';
    private $redis;
    public $ip = '127.0.0.1';
    public $port = 6379;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect($this->ip, $this->port);
    }

    public function set(Banner $banner){
        $bannerData = serialize($banner);
        return $this->redis->hSet($this->key,$this->key.''.$banner->getID(), $bannerData);
    }

    public function get(int $bannerID){
        $result = $this->redis->hGet($this->key, $this->key.''.$bannerID);
        if($result){
            return unserialize($result);
        }

        return false;
    }

    public function getAll(){
        $result = $this->redis->hGetAll($this->key);
        if($result){
            $banners = [];
            foreach ($result as $banner){
                $banners[] = unserialize($banner);
            }
            return $banners;
        }

        return false;
    }

    public function deleteAll()
    {
        return $this->redis->hDel($this->key);
    }
}