<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstname('demo');
        $user->setLastname('demo');
        $user->setEmail('demo@demo.fr');
        $user->setPostalcode('75013');
        $user->setPassword($this->encoder->encodePassword($user, 'demo'));
        $user->setRegistrationDate(new \DateTime('now'));
        $user->setRole('ROLE_ADMIN');
        $manager->persist($user);
        $manager->flush();
    }
}
