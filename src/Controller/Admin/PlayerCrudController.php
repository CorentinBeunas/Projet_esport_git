<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //AssociationField::new('user')
                //->setFormTypeOptions([
                    //'choice_label' => 'email',
                //])
                //->setRequired(true),
            TextField::new('user', 'email'),
	    TextField::new('name', 'NOM DU JOUEUR'),
            TextField::new('role'),
            TextField::new('champions'),
            IntegerField::new('wins'),
            IntegerField::new('losses'),
            NumberField::new('winrate', 'Winrate (%)'),
            NumberField::new('kda', 'KDA moyen'),         
            AssociationField::new('team', 'Équipe'),

        ];
    }
}
