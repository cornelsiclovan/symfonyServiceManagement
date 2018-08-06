<?php

namespace App\DataFixtures;

use App\Entity\StaffType;
use Doctrine\Common\Persistence\ObjectManager;

class StaffTypeFixture extends BaseFixtures
{
    static $i = 0;
    protected function loadData(ObjectManager $manager)
    {
        $roles = array('Adminstrative', 'Management assist', 'Cleaning', 'Judicial', 'Maintenance');

        $this->createMany(StaffType::class, 5, function(StaffType $staffType) use ($roles) {
            $staffType->setType($roles[StaffTypeFixture::$i++]);
        });

        $manager->flush();
    }
}
