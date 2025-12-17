<?php

namespace App\Security;

use App\Entity\Player;
use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();

        // 🔹 Si c'est un admin → on envoie vers /admin
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new RedirectResponse($this->urlGenerator->generate('admin'));
        }

        // 🔹 Si c'est un joueur → on envoie vers /player/dashboard
        if (in_array('ROLE_PLAYER', $user->getRoles())) {
            return new RedirectResponse($this->urlGenerator->generate('player_dashboard'));
        }

        // 🔹 Par défaut (devrait pas arriver)
        return new RedirectResponse('/');
    }
}

