<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\AnimalRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid as Uuid;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Uuid\UuidInterface
     *
     * @ORM\Column(name="uuid", type="uuid", unique=true)
     * @Serializer\SerializedName("id")
     * @Serializer\Type("uuid")
     */
    private $uuid;

    /**
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="dateUpdate", type="datetime", nullable=true)
     */
    private $dateUpdate;

    /**
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\SerializedName("name")
     *
     */
    private $name;

    /**
     * @ORM\Column(name="gender", type="string", columnDefinition="enum('male', 'femele')")
     * @Serializer\SerializedName("gender")
     */
    private $gender;

    /**
     * @ORM\Column(name="age", type="integer")
     * @Serializer\SerializedName("age")
     */
    private $age;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Serializer\SerializedName("description")
     */
    private $description;

    public function __construct()
    {
        $this->uuid = Uuid\Uuid::uuid4();
        $this->dateCreation = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid\UuidInterface
    {
        return $this->uuid;
    }

    public function getDateCreation(): ?DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateUpdate(): ?DateTime
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(?DateTime $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    public function getDeleted(): ?DateTime
    {
        return $this->deleted;
    }

    public function setDeleted(?DateTime $deleted): self
    {
        $this->deleted = $deleted;

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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
