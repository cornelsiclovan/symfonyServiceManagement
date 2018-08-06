<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use App\Entity\Staff;
use App\Entity\StaffType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class StaffFixture extends BaseFixtures
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Staff::class, 10, function(Staff $staff){
            $staff->setName($this->faker->name());
            $staff->setEmail($this->faker->email());
            $staff->setPassword('password');
        });

        $manager->flush();
    }
}