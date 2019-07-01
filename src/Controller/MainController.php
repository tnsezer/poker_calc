<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 23.07.2018
 * Time: 19:32
 */
namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Deck;
use App\Entity\CardFactory;


class MainController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @Route("/", name="main")
     */
    public function main(){

        return $this->render('main.html.twig', ['suits' => Deck::SUITS, 'ranks' => Deck::RANKS]);
    }

    /**
     * @Route("/start", name="start")
     *
     * @param GameRepository $gameRepository
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function start(GameRepository $gameRepository, Request $request){
        $suit = $request->get("suit");
        $rank = $request->get("rank");
        $card = CardFactory::create($suit, $rank);
        $gameRepository->start($card);
        $history = $gameRepository->getHistory();
        $chance = $gameRepository->calculateChance();

        $data = [
            'card' => $card->get(),
            'history' => $history,
            'selectedCard' => '-',
            'chance' => $chance,
            'win' => 0
        ];

        return $this->render('draft.html.twig', ['data' => $data]);
    }

    /**
     * @Route("/draft", name="draft")
     *
     * @param GameRepository $gameRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function draft(GameRepository $gameRepository){
        $card = $gameRepository->selectCard();
        $myCard = $gameRepository->getMyCard();
        $history = $gameRepository->getHistory();
        $win = $gameRepository->compareCard($card);
        $chance = $gameRepository->calculateChance();

        $data = [
            'card' => $myCard,
            'history' => $history,
            'selectedCard' => $card->get(),
            'chance' => $chance,
            'win' => $win
        ];

        return $this->render('draft.html.twig', ['data' => $data]);
    }

    /**
     * @Route("/reset", name="reset")
     *
     * @param GameRepository $gameRepository
     *
     * @return RedirectResponse
     */
    public function reset(GameRepository $gameRepository){
        $gameRepository->reset();

        return $this->redirectToRoute('main');
    }
}