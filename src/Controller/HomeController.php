<?php

namespace App\Controller;

use App\Repository\CatPictureRepository;
use App\Repository\CatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CatRepository $catRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'catOfTheMonth' => $catRepository->findBy(['catOfTheMonth' => true]),
        ]);
    }
}
