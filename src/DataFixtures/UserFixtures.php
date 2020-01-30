<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('alexandre.coulon97@gmail.com');
        $user->setFirstname('Alexandre');
        $user->setLastname('COULON');
        $user->setAddress($faker->address);
        $user->setPhone('06.00.00.00.00' );
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@gmail.com');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->setAddress($faker->address);
        $user->setPhone('06.00.00.00.00' );
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $manager->persist($user);

        $manager->flush();
    }
}
