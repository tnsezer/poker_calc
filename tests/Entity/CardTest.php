<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 21:02
 */
namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Card;

class CardTest extends TestCase
{
    public function testCard()
    {
        $suit = 'A';
        $rank = '1';

        $card = new Card($suit, $rank);

        $this->assertEquals($card->get(), $suit.':'.$rank);
    }
}