<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StaffTypeFixture extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany
        $manager->flush();
    }
}
