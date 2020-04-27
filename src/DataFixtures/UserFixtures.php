<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');

        for($i=0;$i<20;$i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setName($faker->lastName);
            $user->setEmail($faker->email);
            $user->setAdress('5 cours saint louis');
            $user->setCity($faker->city);
            $user->setPassword(password_hash($faker->password, PASSWORD_DEFAULT));
            $date = rand(1950, 2000) . '-' . $faker->month . '-' . $faker->dayOfMonth;

            $user->setBirthdate(new \DateTime($date));
            $user->setRoles((array)'ROLE_USER');
            $manager->persist($user);
        }

        $admin=new User();
        $admin->setFirstname('Francois');
        $admin->setName('Grandsire');
        $admin->setEmail('grandsiref@gmail.com');
        $admin->setAdress('balblkefbajlev0');
        $admin->setCity('aix-en-provence');
        $admin->setPassword(password_hash('admin',PASSWORD_DEFAULT));
        $admin->setRoles((array)'ROLE_ADMIN');
        $manager->persist($admin);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

    }
}
