<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@cats.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('voter@exemple.com');
        $user->setRoles(['ROLE_USER']);
        $this->addReference('user_' . 0, $user);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '1234'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
