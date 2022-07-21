<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Repository\CatRepository;
use App\Repository\RateRepository;
use App\Form\RateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RateController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/vote', name: 'vote', methods: ['GET', 'POST'])]
    public function index(Request $request, CatRepository $catRepository, RateRepository $rateRepository): Response
    {
        /** @var User */
        $user = $this->getUser();/** @phpstan-ignore-line */
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rate->setUserId($user); /** @phpstan-ignore-line */
            $rateRepository->add($rate, true);

            $this->addFlash('success', 'Your vote has been received !');

            return $this->redirectToRoute('vote', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rate/index.html.twig', [
            'cats' => $catRepository->findAll(),
            'form' => $form,
        ]);
    }
}
