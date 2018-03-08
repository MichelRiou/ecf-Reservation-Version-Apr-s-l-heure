<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/03/2018
 * Time: 10:54
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Hostel;
use AppBundle\Entity\Room;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lists = [
            ["type" => 'Double', 'price' => 15],
            ["type" => 'Simple', 'price' => 20],
            ["type" => 'Suite', 'price' => 125],
            ["type" => 'Double Royale', 'price' => 25],
            ["type" => 'Suite Royale', 'price' => 200],

        ];
        for($i=1;$i<=3;$i++) {
            $cpt = 1;
            foreach ($lists as $list) {
                $hostel_reference="hotel_". $i;
                $room = new Room();
                $room->setCapacity(2)
                    ->setNote(5)
                    ->setNumero($cpt++)
                    ->setPrice($list["price"])
                    ->setHostel($this->getReference($hostel_reference))
                    ->setType($list["type"]);

            $manager->persist($room);
        }
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
        return 5;
    }
}
