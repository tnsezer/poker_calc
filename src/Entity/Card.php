<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 21:02
 */
namespace App\Entity;

class Card implements CardInterface
{

    public $suit;
    public $rank;

    /**
     * Constructor
     *
     * @param string $suit
     * @param string $rank
     */
    public function __construct(string $suit, string $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function get()
    {
        return $this->suit . ':' . $this->rank;
    }
}