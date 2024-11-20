<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Toy;
use App\Entity\Brand;

class ToyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Define the data
        $toys = [
            [
                "name" => "Puzzle",
                "minimumAge" => 5,
                "brand_name" => "Mattel",
            ],
            [
                "name" => "Barbie",
                "minimumAge" => 3,
                "brand_name" => "Mattel",
            ],
            [
                "name" => "Robot",
                "minimumAge" => 12,
                "brand_name" => "Hasbro",
            ],
        ];


        foreach($toys as $t) {
            $toy = new Toy();
            $toy->setName($t["name"]);
            $toy->setMinimumAge($t["minimumAge"]);

            //Retrouver la marque dont l'id est fourni
            $repository = $manager->getRepository(Brand::class);
            $brand = $repository->findOneByName($t["brand_name"]);

            $toy->setBrand($brand);

            $manager->persist($toy);
        }

        $manager->flush();
    }
}
