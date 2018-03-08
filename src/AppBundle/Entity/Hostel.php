<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Hostel
 *
 * @ORM\Table(name="hostels")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HostelRepository")
 */
class Hostel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message="L'adresse est obligatoire")
     * @ORM\Column(name="adress", type="string", length=150)
     */
    private $adress;

    /**
     * @var string
     * @Assert\NotBlank(message="Le code postal est obligatoire")
     * @ORM\Column(name="zipcod", type="string", length=5)
     */
    private $zipcod;

    /**
     * @var string
     * @Assert\NotBlank(message="La ville est obligatoire")
     * @ORM\Column(name="city", type="string", length=150)
     */
    private $city;


    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Room", mappedBy="hostel")
     */
    private $rooms;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hostel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Hostel
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set zipcod
     *
     * @param string $zipcod
     *
     * @return Hostel
     */
    public function setZipcod($zipcod)
    {
        $this->zipcod = $zipcod;

        return $this;
    }

    /**
     * Get zipcod
     *
     * @return string
     */
    public function getZipcod()
    {
        return $this->zipcod;
    }

    /**
     * @return ArrayCollection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param ArrayCollection $rooms
     * @return Hostel
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
        return $this;
    }





    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return Hostel
     */
    public function addRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \AppBundle\Entity\Room $room
     */
    public function removeRoom(\AppBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

   

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Hostel
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

}
