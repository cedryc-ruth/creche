<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Brand;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                "name" => "Mattel",
            ],
            [
                "name" => "Hasbro",
            ],
        ];
        
        foreach($data as $d) {
            $brand = new Brand();
            $brand->setName($d["name"]);

            $manager->persist($brand);
        }

        $manager->flush();
    }
}
