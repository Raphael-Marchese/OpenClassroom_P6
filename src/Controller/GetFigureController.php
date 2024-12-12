<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\FigureRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class GetFigureController extends AbstractController
{
    #[Route('/figure/{id}', name: 'app_single_figure',requirements: ['id' => '\d+'])]
    public function __invoke(int $id, #[CurrentUser] ?User $user, FigureRepository $figureRepository, MessageRepository $messageRepository): Response
    {
        $singleFigure = $figureRepository->find($id);

        $comments = $messageRepository->findBy(['figure' => $singleFigure]);

        $medias = ['https://picsum.photos/id/237/200/300', 'https://picsum.photos/seed/picsum/200/300', 'https://picsum.photos/200/300/?blur'];

        if (!$singleFigure) {
            throw $this->createNotFoundException('La figure demandée n\'existe pas.');
        }
        return $this->render('figure/index.html.twig', [
            'figure' => $singleFigure,
            'medias' => $medias,
            'comments' => $comments,
        ]);
    }
}
