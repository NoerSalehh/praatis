<?php

namespace App\Controller;

use App\Entity\Lokaal;
use App\Form\LokaalType;
use App\Repository\LokaalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lokaal")
 */
class LokaalController extends AbstractController
{
    /**
     * @Route("/", name="lokaal_index", methods={"GET"})
     */
    public function index(LokaalRepository $lokaalRepository): Response
    {
        return $this->render('lokaal/index.html.twig', [
            'lokaals' => $lokaalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lokaal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lokaal = new Lokaal();
        $form = $this->createForm(LokaalType::class, $lokaal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lokaal);
            $entityManager->flush();

            return $this->redirectToRoute('lokaal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lokaal/new.html.twig', [
            'lokaal' => $lokaal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lokaal_show", methods={"GET"})
     */
    public function show(Lokaal $lokaal): Response
    {
        return $this->render('lokaal/show.html.twig', [
            'lokaal' => $lokaal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lokaal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lokaal $lokaal): Response
    {
        $form = $this->createForm(LokaalType::class, $lokaal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lokaal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lokaal/edit.html.twig', [
            'lokaal' => $lokaal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lokaal_delete", methods={"POST"})
     */
    public function delete(Request $request, Lokaal $lokaal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lokaal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lokaal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lokaal_index', [], Response::HTTP_SEE_OTHER);
    }
}
