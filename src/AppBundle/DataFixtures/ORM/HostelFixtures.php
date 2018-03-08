<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/03/2018
 * Time: 10:54
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Hostel;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HostelFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lists = [
            ["ville" => 'PARIS', 'codpos' => '75001'],
            ["ville" => 'MARSEILLE', 'codpos' => '85001'],
            ["ville" => 'LYON', 'codpos' => '35001']

        ];
        $cpt=1;
        foreach ($lists as $list) {
            $hostel = new Hostel();
            $hostel->setName('Hotel de ' . $list["ville"])
                ->setAdress('Rue de ' . $list["ville"])
                ->setZipcod($list["codpos"])
                ->setCity($list["ville"]);
            $this->addReference("hotel_" . $cpt++, $hostel);
            $manager->persist($hostel);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
