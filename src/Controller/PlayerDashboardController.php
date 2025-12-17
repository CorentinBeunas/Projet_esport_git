<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class PlayerDashboardController extends AbstractController
{
    #[Route('/player', name: 'player_dashboard')]
    #[IsGranted('ROLE_PLAYER')]
    public function index(UserInterface $user): Response
    {
        return $this->render('player/dashboard.html.twig', [
            'user' => $user,
        ]);
    }
}
