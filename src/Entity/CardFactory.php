<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 21:02
 */
namespace App\Entity;

use App\DependencyInjection\Suit;
use App\DependencyInjection\Rank;

class CardFactory
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

    public $deck = [];

    public function __construct()
    {

    }

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
}