<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CatFixtures extends Fixture
{
    public const CATNAMES = ['Minette', 'Jae', 'Imhotep', 'Lou', 'Zelda', 'Midnight'];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < count(self::CATNAMES); $i++) {
            $cat = new Cat();
            $cat->setName(self::CATNAMES[$i]);
            $cat->setDateOfBirth($faker->dateTimeBetween('-12 years', '-5 years'));
            $cat->setDescription($faker->paragraph(3));
            $cat->setGoodPoint($faker->sentence(1));
            $cat->setBadPoint($faker->sentence(1));
            if ($i === 1) {
                $cat->setCatOfTheMonth(true);
            } else {
                $cat->setCatOfTheMonth(false);
            }
            $manager->persist($cat);
        }
        $manager->flush();
    }
}
