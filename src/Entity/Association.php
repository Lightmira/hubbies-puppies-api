<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 */
class Association
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var UuidInterface
     *
     * @ORM\Column(name="uuid", type="uuid", unique=true)
     * @Serializer\SerializedName("id")
     * @Serializer\Type("uuid")
     */
    private $uuid;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\SerializedName("name")
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Serializer\SerializedName("logo")
     */
    private $logo;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\SerializedName("description")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20)
     * @Serializer\SerializedName("phone")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Serializer\SerializedName("cellphone")
     */
    private $cellphone;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\SerializedName("email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\SerializedName("address")
     */
    private $address;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function setCellphone(?string $cellphone): self
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
