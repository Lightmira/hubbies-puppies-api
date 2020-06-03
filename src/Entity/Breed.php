<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\BreedRepository;
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
 *     schema="Breed"
 * )
 *
 * @ORM\Table(name="breed")
 * @ORM\Entity(repositoryClass=BreedRepository::class)
 */
class Breed
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
     * @Serializer\Groups({"breed_default"})
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
     * @Serializer\Groups({"breed_default"})
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
     *     property="label",
     *     example="Berger Allemand",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="label", type="string", length=100)
     * @Serializer\SerializedName("label")
     * @Serializer\Groups({"breed_default"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="breed")
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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
            $animal->setBreed($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->contains($animal)) {
            $this->animals->removeElement($animal);
            // set the owning side to null (unless already changed)
            if ($animal->getBreed() === $this) {
                $animal->setBreed(null);
            }
        }

        return $this;
    }
}
