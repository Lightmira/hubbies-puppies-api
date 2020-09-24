<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\AnimalRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use Ramsey\Uuid as Uuid;

/**
 * @OA\Schema(
 *     type="object",
 *     schema="Animal"
 * )
 *
 * @ORM\Table(name="animal")
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @OA\Property(
     *     type="integer",
     *     property="id",
     *     nullable=false
     * )
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Uuid\UuidInterface
     *
     * @OA\Property(
     *     type="string",
     *     property="uuid",
     *     format="uuid",
     *     example="0b6b9865-4583-48a6-959c-233cef91285a",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="uuid", type="uuid", unique=true)
     * @Serializer\SerializedName("id")
     * @Serializer\Type("uuid")
     * @Serializer\Groups({"animal_default"})
     */
    private $uuid;

    /**
     * @OA\Property(
     *     type="string",
     *     property="dateCreation",
     *     example="2020-05-11T14:00:00",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     * @Serializer\Groups({"animal_default"})
     */
    private $dateCreation;

    /**
     * @OA\Property(
     *     type="string",
     *     property="dateUpdate",
     *     example="2020-05-11T14:00:00",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="dateUpdate", type="datetime", nullable=true)
     */
    private $dateUpdate;

    /**
     * @OA\Property(
     *     type="string",
     *     property="deleted",
     *     example="2020-05-11T14:00:00",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;

    /**
     * @OA\Property(
     *     type="string",
     *     property="name",
     *     example="Milou",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\SerializedName("name")
     * @Serializer\Groups({"animal_default"})
     */
    private $name;

    /**
     * @OA\Property(
     *     type="array",
     *     property="gender",
     *     nullable=false,
     *     @OA\Items(
     *         type="string"
     *     ),
     *     example={
     *         "male",
     *         "female"
     *     }
     * )
     *
     * @ORM\Column(name="gender", type="string")
     * @Serializer\SerializedName("gender")
     * @Serializer\Groups({"animal_default"})
     */
    private $gender;

    /**
     * @OA\Property(
     *     type="integer",
     *     property="age",
     *     example=10,
     *     nullable=false
     * )
     *
     * @ORM\Column(name="age", type="integer")
     * @Serializer\SerializedName("age")
     * @Serializer\Groups({"animal_default"})
     */
    private $age;

    /**
     * @OA\Property(
     *     type="string",
     *     property="description",
     *     example="Milou has been found on the street, ...",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Serializer\SerializedName("description")
     * @Serializer\Groups({"animal_default"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $association;

    /**
     * @ORM\ManyToOne(targetEntity=Breed::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $breed;

    /**
     * @ORM\ManyToOne(targetEntity=Species::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

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

    public function setUuid(Uuid\UuidInterface $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
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

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }
}
