<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoachController extends AbstractController
{
    #[Route('/coach', name: 'coach_dashboard')]
    public function index(): Response
    {
        return new Response("Bienvenue COACH !");
    }
}