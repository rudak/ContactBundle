<?php
/**
 * Created by PhpStorm.
 * User: Rudak
 * Date: 11/11/2014
 * Time: 09:09
 */

namespace Rcm\RugbyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Rudak\BlogBundle\Utils\Namer;
use Rudak\BlogBundle\Utils\Syllabeur;
use Rudak\ContactBundle\Entity\Contact;


class loadContacts implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $tab = array();
        for ($i = 0; $i < rand(15, 35); $i++) {
            $tab[$i] = new Contact();
            $tab[$i]->setName(Namer::getFirstName());
            $tab[$i]->setPhone('0' . rand(1, 5) . '.' . rand(15, 99) . '.' . rand(10, 99) . '.' . rand(10, 99) . '.' . rand(10, 99));
            $tab[$i]->setEmail(Syllabeur::getSyllabes(rand(2, 3)) . '@free.fr');
            $tab[$i]->setMessage(Syllabeur::getMots(rand(10, 250)));
            $tab[$i]->setIp(rand(15, 99999));
            $tab[$i]->setDate(new \DateTime(rand(-200, -2) . 'hour'));
            $tab[$i]->setIsRead(rand(0, 1));
            $manager->persist($tab[$i]);

            echo '.';
        }
        echo "\n";
        $manager->flush();
    }
} 