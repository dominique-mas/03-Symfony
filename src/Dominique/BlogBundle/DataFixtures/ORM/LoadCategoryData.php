<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dominique\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dominique\BlogBundle\Entity\Category;

/**
 * Description of LoadCategoryData
 *
 * @author Dominique
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface {
    
    public function load(ObjectManager $manager) {
        
        $category = new Category;
        $category->setName("Catégorie test");
        
        $manager->persist($category);
        $manager->flush();
        
        $this->addReference('category-test', $category);
    }

    public function getOrder() {
        return 1;
    }

}
