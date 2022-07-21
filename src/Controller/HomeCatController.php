<?php

namespace App\Controller;

use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cats', name: 'cats_')]
class HomeCatController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CatRepository $catRepository): Response
    {
        return $this->render('cats/index.html.twig', [
            'cats' => $catRepository->findAll(),
        ]);
    }
}
