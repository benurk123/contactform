<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=100)
     */
    private $naam;
    /**
     * @ORM\Column(type="text")
     */
    private $email;
    /**
     * @ORM\Column(type="text")
     */
    private $telefoonnummer;
//    /**
//     * @ORM\Column(type="text")
//     */
    public function getId()
    {
        return $this->id;
    }
    public function getNaam()
    {
        return $this->naam;
    }
    public function setNaam($naam)
    {
        return $this->naam = $naam;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function getTelefoonnummer()
    {
        return $this->telefoonnummer;
    }
    public function setTelefoonnummer($telefoonnummer)
    {
        return $this->telefoonnummer = $telefoonnummer;
    }
}

