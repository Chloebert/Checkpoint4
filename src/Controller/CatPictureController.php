<?php

namespace App\Controller;

use App\Entity\CatPicture;
use App\Form\CatPictureType;
use App\Repository\CatPictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/picture')]
class CatPictureController extends AbstractController
{
    #[Route('/', name: 'app_cat_picture_index', methods: ['GET'])]
    public function index(CatPictureRepository $catPictureRepository): Response
    {
        return $this->render('admin/cat_picture/index.html.twig', [
            'cat_pictures' => $catPictureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cat_picture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CatPictureRepository $catPictureRepository): Response
    {
        $catPicture = new CatPicture();
        $form = $this->createForm(CatPictureType::class, $catPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catPictureRepository->add($catPicture, true);

            return $this->redirectToRoute('app_cat_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/cat_picture/new.html.twig', [
            'cat_picture' => $catPicture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_picture_show', methods: ['GET'])]
    public function show(CatPicture $catPicture): Response
    {
        return $this->render('admin/cat_picture/show.html.twig', [
            'cat_picture' => $catPicture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cat_picture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CatPicture $catPicture, CatPictureRepository $catPictureRepository): Response
    {
        $form = $this->createForm(CatPictureType::class, $catPicture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catPictureRepository->add($catPicture, true);

            return $this->redirectToRoute('app_cat_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/cat_picture/edit.html.twig', [
            'cat_picture' => $catPicture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cat_picture_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        CatPicture $catPicture,
        CatPictureRepository $catPictureRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $catPicture->getId(), $request->request->get('_token'))) {
            $catPictureRepository->remove($catPicture, true);
        }

        return $this->redirectToRoute('app_cat_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}
