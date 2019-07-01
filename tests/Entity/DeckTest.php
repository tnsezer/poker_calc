<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 24.07.2018
 * Time: 20:02
 */
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\CardFactory;
use App\Entity\Deck;

class DeckTest extends TestCase
{
    public function testDeck(){
        $cardFactory = new CardFactory;
        $deck = new Deck($cardFactory);
        $result = $deck->get();

        $this->assertEquals(52, count($result));
    }

    public function testDraftCard(){
        $cardFactory = new CardFactory;
        $deck = new Deck($cardFactory);
        $result1 = $deck->get();
        $deck->draftCard();
        $result2 = $deck->get();

        $this->assertEquals(count($result1) - 1, count($result2));
    }
}