<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=80)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=80)
     */
    private $surnames;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank()
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=1)
	 * @Assert\NotBlank()
	 * @Assert\Length(min=1,max=1)
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
	 * @Assert\NotBlank()
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=20)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=20)
     */
    private $identificationNumber;

    /**
     * @ORM\Column(type="integer")
	 * @Assert\Regex(pattern="/^[0-9]+$/",match=true,message="Debe contener solo números. ")
     */
    private $childrenAmount;

    /**
     * @ORM\Column(type="string", length=20)
	 * @Assert\NotBlank()
     * @Assert\Length(max=20)
     */
    private $race;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
	 * @Assert\NotBlank()
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=35)
     * @Assert\Regex(pattern="/^[a-z,A-Z, ,ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,Ñ,-,']+$/",match=true,message="Debe contener solo letras")
     * @Assert\NotBlank()
     * @Assert\Length(max=35)
     */
    private $charge;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurnames(): ?string
    {
        return $this->surnames;
    }

    public function setSurnames(string $surnames): self
    {
        $this->surnames = $surnames;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getIdentificationNumber(): ?string
    {
        return $this->identificationNumber;
    }

    public function setIdentificationNumber(string $identificationNumber): self
    {
        $this->identificationNumber = $identificationNumber;

        return $this;
    }

    public function getChildrenAmount(): ?int
    {
        return $this->childrenAmount;
    }

    public function setChildrenAmount(int $childrenAmount): self
    {
        $this->childrenAmount = $childrenAmount;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCharge(): ?string
    {
        return $this->charge;
    }

    public function setCharge(string $charge): self
    {
        $this->charge = $charge;

        return $this;
    }
}
