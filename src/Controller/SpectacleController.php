<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Form\SpectacleSearchType;
use App\Repository\SpectacleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spectacles")
 */
class SpectacleController extends AbstractController
{
    /**
     * @Route("/", name="spectacles_index", methods={"GET"})
     */
    public function index(SpectacleRepository $spectacleRepository, Request $request): Response
    {
        $form = $this->get('form.factory')->createNamed('', SpectacleSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $spectacles = $spectacleRepository->findLikeName($search);
        } else {
            $spectacles = $spectacleRepository->findBy([], ['date' => 'ASC']);
        }

        return $this->render('spectacle/index.html.twig', [
            'spectacles' => $spectacles,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="spectacles_show", methods={"GET"})
     */
    public function show(Spectacle $spectacle): Response
    {
        return $this->render('spectacle/show.html.twig', [
            'spectacle' => $spectacle,
        ]);
    }

    /**
     * @Route("/book/{id}", name="spectacles_book", methods={"GET"})
     */
    public function book(Spectacle $spectacle, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $spectacle->addReservation($user);
        $spectacle->setPlaces($spectacle->getPlaces() - 1);
        $entityManager->persist($spectacle);
        $entityManager->flush();
        $this->addFlash('success', 'Votre place à été réservé.');

        return $this->render('spectacle/booked.html.twig', [
            'spectacle' => $spectacle,
        ]);
    }

    /**
     * @Route("/booked/{id}", name="spectacles_booked", methods={"GET"})
     */
    public function booked(Spectacle $spectacle, EntityManagerInterface $entityManager): Response
    {
        return $this->render('spectacle/booked.html.twig', [
            'spectacle' => $spectacle,
        ]);
    }
}
