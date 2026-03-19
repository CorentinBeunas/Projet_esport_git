<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class PlayerController extends AbstractController
{
    #[Route('/player', name: 'player_dashboard')]
    public function index(): Response
    {
        return new Response("Bienvenue JOUEUR !");
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof Player) {
        return;
    }

    $user = new User();
    $user->setEmail($entityInstance->getPseudo().'@player.com');
    $user->setRoles(['ROLE_PLAYER']);
    $user->setPassword(password_hash('player123', PASSWORD_BCRYPT));

    $entityInstance->setUser($user);

    $entityManager->persist($user);

    parent::persistEntity($entityManager, $entityInstance);
}
}
