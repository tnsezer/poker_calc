<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 21:02
 */
namespace App\Entity;

use App\Entity\Suit;
use App\Entity\Rank;

class Card
{
    const SUITS = ["D", "C", "H", "S"];
    const RANKS = [
        "A",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
        "10",
        "J",
        "Q",
        "K"
    ];

    private $deck = [];

    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function createDeck(){
        $this->deck = [];
        foreach (self::SUITS as $suit){
            $suitClass = new Suit($suit);
            foreach (self::RANKS as $rank){
                $this->deck[] = (new Rank($suitClass))->set($rank)->get();
            }
        }

        shuffle($this->deck);

        return $this->deck;
    }

    /**
     * @return mixed
     */
    public function draftCard(){
        $card = current($this->deck);
        array_shift($this->deck);

        return $card;
    }

    /**
     * @param array $deck
     * @return $this
     */
    public function set(array $deck){
        $this->deck = $deck;

        return $this;
    }

    /**
     * @return array
     */
    public function get(){
        return $this->deck;
    }
}