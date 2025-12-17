<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // password : onlyOnForms() et mapped => false (on ne mappe pas directement sur la propriété password)
        return [
            EmailField::new('email', 'Email'),
            TextField::new('plainPassword', 'Mot de passe en clair')
                ->onlyOnForms()
                ->setFormTypeOptions(['mapped' => false, 'required' => $pageName === 'new']),
            ChoiceField::new('roles', 'Rôles')
                ->allowMultipleChoices()
                ->setChoices([
                    'Coach' => 'ROLE_COACH',
                    'Player' => 'ROLE_PLAYER',
                ]),
        ];
    }

    /**
     * Lorsque l'on crée un nouvel utilisateur.
     */
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!($entityInstance instanceof User)) {
            return;
        }

        // Récupérer le mot de passe en clair depuis la requête (form field non mappé)
        $adminContext = $this->getContext();
        $request = $adminContext instanceof AdminContext ? $adminContext->getRequest()->request : null;

        $plainPassword = null;
        if ($request) {
            $data = $request->get('User') ?? $request->all('User') ?? null;
            if (is_array($data) && array_key_exists('plainPassword', $data)) {
                $plainPassword = $data['plainPassword'];
            } elseif (is_array($data) && array_key_exists('password', $data)) {
                // selon ton formulaire ça peut s'appeler 'password'
                $plainPassword = $data['password'];
            }
        }

        if ($plainPassword) {
            $hashed = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
            $entityInstance->setPassword($hashed);
        }

        // Persister l'utilisateur
        $em->persist($entityInstance);

        // Si l'utilisateur est un joueur, créer automatiquement un Player lié s'il n'existe pas
        $roles = $entityInstance->getRoles();
        if (in_array('ROLE_PLAYER', $roles, true)) {
            if (null === $entityInstance->getPlayer()) {
                $player = new Player();
                $player->setUser($entityInstance);
                // on peut initialiser des valeurs par défaut si besoin
                $em->persist($player);
                $entityInstance->setPlayer($player);
            }
        }

        $em->flush();
    }

    /**
     * Lorsque l'on met à jour un utilisateur existant.
     * On doit aussi hacher un nouveau mot de passe si l'admin en a fourni un.
     */
    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!($entityInstance instanceof User)) {
            return;
        }

        // vérifier mot de passe en clair comme dans persistEntity
        $adminContext = $this->getContext();
        $request = $adminContext instanceof AdminContext ? $adminContext->getRequest()->request : null;

        $plainPassword = null;
        if ($request) {
            $data = $request->get('User') ?? $request->all('User') ?? null;
            if (is_array($data) && array_key_exists('plainPassword', $data)) {
                $plainPassword = $data['plainPassword'];
            } elseif (is_array($data) && array_key_exists('password', $data)) {
                $plainPassword = $data['password'];
            }
        }

        if ($plainPassword) {
            $hashed = $this->passwordHasher->hashPassword($entityInstance, $plainPassword);
            $entityInstance->setPassword($hashed);
        }

        $em->persist($entityInstance);
        $em->flush();
    }
}
