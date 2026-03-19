<?php

namespace App\Controller\Admin;

use App\Entity\Esport;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class EsportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Esport::class;
    }
public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->onlyOnIndex(),
        TextField::new('name', 'Nom de l’équipe'),

        // Nouveau : infos membres
        UrlField::new('membresLink', 'Voir Membres')->onlyOnIndex(),
        IntegerField::new('taille_equipe', 'Taille de l’équipe'),
        // Compétition
        TextField::new('competition', 'Compétition'),

        // jeu
        TextField::new('jeu', 'jeu'),

        // Capitaine
        TextField::new('capitaine', 'Capitaine'),

        // Coach
        TextField::new('coach', 'Coach'),

	TextField::new('competition', 'Compétition'),
	TextField::new('capitaine', 'Capitaine'),
	TextField::new('coach', 'Coach'),
    ];
}

}
