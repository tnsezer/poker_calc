<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 21:02
 */
namespace App\Entity;

use App\Entity\CardFactory;

class Deck
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

    /**
     * @var Card[]
     */
    private $deck = [];

    /**
     * @var CardFactory
     */
    private $cardFactory;

    /**
     * Constructor
     *
     * @param \App\Entity\CardFactory $cardFactory
     */
    public function __construct(CardFactory $cardFactory)
    {
        $this->cardFactory = $cardFactory;

        $this->createDeck();
    }

    /**
     * @return array
     */
    public function createDeck(){
        $this->deck = [];
        foreach (self::SUITS as $suit){
            foreach (self::RANKS as $rank){
                $card = $this->cardFactory->create($suit, $rank);
                $this->deck[$card->get()] = $card;
            }
        }

        shuffle($this->deck);

        return $this->deck;
    }

    /**
     * @param array $deck
     *
     * @return $this
     */
    public function except(array $deck)
    {
        foreach ($this->deck as $index => $card) {
            if (isset($deck[$card->get()])) {
                unset($this->deck[$index]);
            }
        }

        return $this;
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
     * @return array
     */
    public function get(){
        return $this->deck;
    }
}