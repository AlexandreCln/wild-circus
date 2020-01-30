<?php

namespace App\Controller;


use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    const LIMIT = 4;

    /**
     * @Route("/", name="index")
     */
    public function index(SpectacleRepository$spectacleRepository) {

        return $this->render('home/index.html.twig', [
            'spectacles' => $spectacleRepository->findBy([], ['date' => 'ASC'], self::LIMIT, 0)
        ]);
    }

}