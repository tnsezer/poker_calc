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

        return $this->render('main.html.twig', ['suits' => CardFactory::SUITS, 'ranks' => CardFactory::RANKS]);
    }

    /**
     * @Route("/start", name="start")
     */
    public function start(GameRepository $gameRepository, Request $request){
        $myCard = $request->get("suit") . $request->get("rank");
        $gameRepository->start($myCard);
        $chance = $gameRepository->calculateChance();

        $data = [
            'card' => $myCard,
            'selectedCard' => '-',
            'chance' => $chance,
            'win' => 0
        ];

        return $this->render('draft.html.twig', ['data' => $data]);
    }

    /**
     * @Route("/draft", name="draft")
     */
    public function draft(GameRepository $gameRepository){
        $card = $gameRepository->selectCard();
        $myCard = $gameRepository->myCard();
        $win = $gameRepository->compareCard($card);
        $chance = $gameRepository->calculateChance();

        $data = [
            'card' => $myCard,
            'selectedCard' => $card,
            'chance' => $chance,
            'win' => $win
        ];

        return $this->render('draft.html.twig', ['data' => $data]);
    }

    /**
     * @Route("/reset", name="reset")
     */
    public function reset(GameRepository $gameRepository){
        $gameRepository->reset();

        return $this->redirectToRoute('main');
    }
}