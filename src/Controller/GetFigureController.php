<?php

namespace App\Controller;

use App\Repository\FigureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetFigureController extends AbstractController
{
    #[Route('/figure/{id}', name: 'app_single_figure',requirements: ['id' => '\d+'])]
    public function index(int $id, FigureRepository $figureRepository): Response
    {
        $singleFigure = $figureRepository->find($id);

        $medias = ['https://picsum.photos/id/237/200/300', 'https://picsum.photos/seed/picsum/200/300', 'https://picsum.photos/200/300/?blur'];

        if (!$singleFigure) {
            throw $this->createNotFoundException('La figure demandée n\'existe pas.');
        }
        return $this->render('figure/index.html.twig', [
            'figure' => $singleFigure,
            'medias' => $medias,
        ]);
    }
}
