<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setUsername('admin');
         $user->setPassword('$argon2i$v=19$m=1024,t=2,p=2$UndoMlR1Z0ZkUXBYckc2RQ$UXFBAnJpCMDwube3cf749mRDe0xIl1DjJEr3hW3LLmk');

         $manager->persist($user);

        $manager->flush();
    }
}
