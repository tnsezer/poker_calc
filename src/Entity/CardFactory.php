<?php

namespace App\Entity;

use App\Entity\Card;

class CardFactory
{

    /**
     * @param string $suit
     * @param string $rank
     *
     * @return \App\Entity\Card
     */
    public static function create(string $suit, string $rank)
    {
        return new Card($suit, $rank);
    }
}