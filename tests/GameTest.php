<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 24.07.2018
 * Time: 20:02
 */
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Util\Calculator;
use App\Entity\Card;

class GameTest extends TestCase
{
    public function testCalculate(){
        $result = Calculator::calculate(2, 1);

        $this->assertEquals(50, $result);
    }

    public function testDeck(){
        $cardFactory = new Card();
        $result = $cardFactory->createDeck();

        $this->assertEquals(52, count($result));
    }

    public function testDraftCard(){
        $cardFactory = new Card();
        $deck = $cardFactory->createDeck();
        $card = $cardFactory
            ->set($deck)
            ->draftCard();
        $newDeck = $cardFactory->get();

        $this->assertEquals(count($deck) - 1, count($newDeck));
    }
}