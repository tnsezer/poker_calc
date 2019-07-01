<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 22:52
 */
namespace App\Repository;

use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Deck;
use App\Entity\Card;
use App\Util\Calculator;

class GameRepository
{

    /**
     * @var array|mixed
     */
    private $state = [];

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Deck
     */
    private $deck;

    /**
     * Constructor
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->deck =  $deck;
        $this->session = new Session();
        $state = $this->session->get('state');
        if($state){
            $this->state = unserialize($state);
        }
    }

    /**
     * @return bool
     */
    public function reset() {
        $this->session->remove("state");
        $this->state = [];

        return true;
    }

    /**
     * @param Card $card
     * @return array|mixed
     */
    public function start(Card $card) {
        $deck = $this->deck->get();
        $this->state = ['deck' => $deck, 'card' => $card->get(), 'history' => []];

        $this->save();

        return $this->state;
    }

    /**
     * @return bool
     */
    private function save() {
        if($this->session) {
            return $this->session->set('state', serialize($this->state));
        }

        return false;
    }

    /**
     * @param Card $card
     * @return bool
     */
    public function compareCard(Card $card) {
        return $card->get() === $this->state['card'];
    }

    /**
     * @return mixed
     */
    public function getMyCard(){
        return $this->state['card'];
    }

    /**
     * @return mixed
     */
    public function getHistory(){
        return $this->state['history'];
    }

    /**
     * @return string
     */
    public function selectCard() {
        $deck = $this->deck;
        $card = $deck
            ->except($this->state['history'])
            ->draftCard();

        $cardName = $card->get();
        if(!$this->compareCard($card)) {
            $this->state['deck'] = $deck->get();
        }
        $this->state['history'][$cardName] = $card;

        $this->save();

        return $card;
    }

    /**
     * @return float
     */
    public function calculateChance() {
        return Calculator::calculate(count($this->state['deck']), 1);
    }
}
