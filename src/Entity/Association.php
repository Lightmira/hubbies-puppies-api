<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\AssociationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use Ramsey\Uuid as Uuid;

/**
 * @OA\Schema(
 *     type="object",
 *     schema="Association"
 * )
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 */
class Association
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
     * @Serializer\Groups({"association_default"})
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
     * @Serializer\Groups({"association_default"})
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
     *     example="Melt'in Pets",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\SerializedName("name")
     * @Serializer\Groups({"association_default"})
     */
    private $name;

    /**
     * @OA\Property(
     *     type="string",
     *     property="logo",
     *     example="logo.png",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="logo", type="string", length=100, nullable=true)
     * @Serializer\SerializedName("logo")
     * @Serializer\Groups({"association_default"})
     */
    private $logo;

    /**
     * @OA\Property(
     *     type="string",
     *     property="description",
     *     example="Melt'in Pets has been created in 2005, ...",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Serializer\SerializedName("description")
     * @Serializer\Groups({"association_default"})
     */
    private $description;

    /**
     * @OA\Property(
     *     type="string",
     *     property="phone",
     *     example="0164585960",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="phone", type="string", length=20)
     * @Serializer\SerializedName("phone")
     * @Serializer\Groups({"association_default"})
     */
    private $phone;

    /**
     * @OA\Property(
     *     type="string",
     *     property="cellphone",
     *     example="0664585960",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="cellphone", type="string", length=20, nullable=true)
     * @Serializer\SerializedName("cellphone")
     * @Serializer\Groups({"association_default"})
     */
    private $cellphone;

    /**
     * @OA\Property(
     *     type="string",
     *     property="email",
     *     example="contact@metingpets.fr",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="email", type="string", length=100)
     * @Serializer\SerializedName("email")
     * @Serializer\Groups({"association_default"})
     */
    private $email;

    /**
     * @OA\Property(
     *     type="string",
     *     property="address",
     *     example="42 Queen street",
     *     nullable=true
     * )
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Serializer\SerializedName("address")
     * @Serializer\Groups({"association_default"})
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="association", orphanRemoval=true)
     */
    private $animals;

    public function __construct()
    {
        $this->uuid = Uuid\Uuid::uuid4();
        $this->dateCreation = new DateTime();
        $this->animals = new ArrayCollection();
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

    /**
     * @return Collection|Animal[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->setAssociation($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->contains($animal)) {
            $this->animals->removeElement($animal);
            // set the owning side to null (unless already changed)
            if ($animal->getAssociation() === $this) {
                $animal->setAssociation(null);
            }
        }

        return $this;
    }
}
