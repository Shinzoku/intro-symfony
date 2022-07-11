<?php

namespace App\DataFixtures;


use App\Entity\Tag;
use App\Entity\Category;
use Faker\Factory  as FakerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator  as FakerGenerator;


class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $this->loadCategories($manager, $faker);
        $this->loadTags($manager, $faker);
    }

    public function loadCategories(ObjectManager $manager, FakerGenerator $faker): void
    {
        
        $categoryNames = [
            'cuisine française',
            'cuisine italienne',
            'cuisine ukrainienne',
        ];
        
        foreach ($categoryNames as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
        }

        for ($i=0; $i < 10; $i++) { 
            $category = new Category();
            $category->setName("cuisine {$faker->countryCode()}");
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function loadTags(ObjectManager $manager, FakerGenerator $faker): void
    {
        
        $tagNames = [
            'rapide',
            'végétarien',
            'carné',
        ];
        
        foreach ($tagNames as $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
        }

        for ($i=0; $i < 10; $i++) { 
            $tag = new Tag();
            $tag->setName("cuisine {$faker->word()}");
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
