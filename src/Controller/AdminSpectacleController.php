<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Form\SpectacleType;
use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/spectacles")
 */
class AdminSpectacleController extends AbstractController
{
    /**
     * @Route("/", name="admin_spectacles_index", methods={"GET"})
     */
    public function index(SpectacleRepository $spectacleRepository): Response
    {
        return $this->render('admin_spectacle/index.html.twig', [
            'spectacles' => $spectacleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_spectacles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $spectacle = new Spectacle();
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spectacle);
            $entityManager->flush();
            $this->addFlash('success', 'Le spectacle a été ajouté');

            return $this->redirectToRoute('admin_spectacles_index');
        }

        return $this->render('admin_spectacle/new.html.twig', [
            'admin_spectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_spectacles_show", methods={"GET"})
     */
    public function show(Spectacle $spectacle): Response
    {
        return $this->render('admin_spectacle/show.html.twig', [
            'admin_spectacle' => $spectacle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_spectacles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spectacle $spectacle): Response
    {
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_spectacles_index');
        }

        return $this->render('admin_spectacle/edit.html.twig', [
            'admin_spectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_spectacles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spectacle $spectacle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spectacle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spectacle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_spectacles_index');
    }
}
