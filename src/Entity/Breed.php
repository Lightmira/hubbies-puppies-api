<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\BreedRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid as Uuid;

/**
 * @ORM\Entity(repositoryClass=BreedRepository::class)
 */
class Breed
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
     * @ORM\Column(name="label", type="string", length=100)
     * @Serializer\SerializedName("label")
     */
    private $label;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
