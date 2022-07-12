<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory  as FakerFactory;
use Faker\Generator  as FakerGenerator;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $this->loadCategories($manager, $faker);
        $this->loadTags($manager, $faker);
        $this->loadArticles($manager, $faker);
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
            $tag->setName($faker->word());
            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function loadArticles(ObjectManager $manager, FakerGenerator $faker): void
    {
        $articleDatas = [
            [
                'title' => 'Boeuf bourguignon',
                'body' => 'Un plat français typique',
                'published_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-07-01 09:00:00'),
            ],
            [
                'title' => 'Spaghetti carbonara',
                'body' => 'Un plat italien typique',
                'published_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-07-02 10:00:00'),
            ],
            [
                'title' => 'Borsh',
                'body' => 'Un plat ukrainien typique',
                'published_at' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2022-07-03 11:00:00'),
            ],
        ];

        foreach ($articleDatas as $articleData) {
            $article = new Article();
            $article->setTitle($articleData['title']);
            $article->setBody($articleData['body']);
            $article->setPublishedAt($articleData['published_at']);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
