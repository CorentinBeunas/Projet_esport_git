<?php

namespace App\Controller\Admin;
use App\Entity\Coach;
use App\Entity\User;
use App\Entity\Esport;
use App\Entity\Player;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\PlayerCrudController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
	$url = $routeBuilder->setController(EsportCrudController::class)->generateUrl();
	return $this->redirect($url);
    }
    public function configureDashboard(): Dashboard
    {
	return Dashboard::new()
		->setTitle('projet Esport');
    }
    
    public function configureMenuItems(): iterable
    {
	yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
	yield MenuItem::linkToCrud('Esport', 'fas fa-gamepad', Esport::class);
	yield MenuItem::linkToCrud('Joueurs', 'fa fa-user', Player::class);
	yield MenuItem::linkToCrud('Players', 'fa fa-user', Player::class);
	yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
    }

}
