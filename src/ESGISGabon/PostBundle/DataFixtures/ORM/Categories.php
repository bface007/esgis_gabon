<?php
/**
 * Created by PhpStorm.
 * User: bface007
 * Date: 10/10/15
 * Time: 17:21
 */

namespace ESGISGabon\PostBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ESGISGabon\PostBundle\Entity\Category;

class Categories implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $uncategorized = new Category('Non classé');

        $manager->persist($uncategorized);
        $manager->flush();
    }
}