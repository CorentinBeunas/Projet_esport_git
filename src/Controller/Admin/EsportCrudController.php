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
        IntegerField::new('taille_equipe', 'Taille de l’équipe'),

        // Nouveau : infos membres
        TextField::new('membres', 'Membres')->hideOnIndex(),
        UrlField::new('membresLink', 'Voir Membres')->onlyOnIndex(),

        // Compétition
        TextField::new('competition', 'Compétition'),

        // Palmares
        TextareaField::new('palmares', 'Palmarès'),

        // Capitaine
        TextField::new('capitaine', 'Capitaine'),

        // Coach
        TextField::new('coach', 'Coach'),

        // Tournois gagnés
        IntegerField::new('tournoisGagnes', 'Tournois gagnés'),
	TextField::new('membres', 'Membres')->hideOnIndex(),
	UrlField::new('membresLink', 'Lien membres'),
	TextField::new('competition', 'Compétition'),
	TextareaField::new('palmares', 'Palmarès'),
	TextField::new('capitaine', 'Capitaine'),
	TextField::new('coach', 'Coach'),
	IntegerField::new('tournois_gagnes', 'Tournois gagnés'),
    ];
}

}
