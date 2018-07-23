<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 22:52
 */
namespace App\Repository;

use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\CardFactory;

class GameRepository
{
    public $state = [];
    public $session;

    public function __construct()
    {
        $this->session =  new Session();
        $state = $this->session->get('state');
        if($state){
            $this->state = json_decode($state, true);
        }
    }

    public function reset(){
        $this->session->remove("state");
        $this->state = [];

        return true;
    }

    public function start(string $cardName){
        $card = new CardFactory();
        $deck = $card->createDeck();
        $this->state = ['deck' => $deck, 'card' => $cardName, 'history' => []];

        $this->save();

        return $this->state;
    }

    private function save(){
        $this->session->set('state', json_encode($this->state));
    }

    public function compareCard(string $card){
        return $card == $this->state['card'];
    }

    public function myCard(){
        return $this->state['card'];
    }

    public function selectCard(){
        $card = current($this->state['deck']);
        if(!$this->compareCard($card)) {
            array_shift($this->state['deck']);
        }

        $this->state['history'][] = $card;

        $this->save();

        return $card;
    }

    public function calculate(){
        $chance = (1/ count($this->state['deck'])) * 100;

        return round($chance);
    }
}