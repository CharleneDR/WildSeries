<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
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
        $faker = Factory::create();


        $user = new User();
        $user->setUsername($faker->userName());
        $user->setEmail('user@wildseries.com');
        $user->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'user.1234'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $this->addReference($user->getEmail(), $user);

        $admin = new User();
        $admin->setUsername($faker->userName());
        $admin->setEmail('admin@wildseries.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin.1234'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);
        $this->addReference($admin->getEmail(), $admin);
        
        $manager->flush();


        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
