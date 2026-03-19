<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
{
    return [

        TextField::new('name', 'Nom du joueur'),
        TextField::new('pseudo', 'Pseudo'),
        TextField::new('role'),
        TextField::new('champions'),

        IntegerField::new('wins'),
        IntegerField::new('losses'),

        NumberField::new('winrate', 'Winrate (%)'),
        NumberField::new('kda', 'KDA moyen'),

        AssociationField::new('team', 'Équipe'),

    ];
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