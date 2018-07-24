<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 20:55
 */
namespace App\Entity;

use App\Entity\SuitInterface;
class Suit implements SuitInterface
{
    private $suit;

    public function __construct(string $suit)
    {
        $this->suit = $suit;
    }

    public function get(){
        return $this->suit;
    }
}