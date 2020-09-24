<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;
use OpenApi\Annotations as OA;
use Ramsey\Uuid as Uuid;

/**
 * @OA\Schema(
 *     type="object",
 *     schema="User"
 * )
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
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
     * @Serializer\Groups({"user_default"})
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
     * @Serializer\Groups({"user_default"})
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
     *     property="email",
     *     example="martin.silvercrest@gmail.com",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Serializer\SerializedName("email")
     * @Serializer\Groups({"user_default"})
     */
    private $email;

    /**
     * @OA\Property(
     *     type="string",
     *     property="firstName",
     *     example="Martin",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Serializer\SerializedName("firstName")
     * @Serializer\Groups({"user_default"})
     */
    private $firstName;

    /**
     * @OA\Property(
     *     type="string",
     *     property="lastName",
     *     example="Silvercrest",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Serializer\SerializedName("lastName")
     * @Serializer\Groups({"user_default"})
     */
    private $lastName;

    /**
     * @OA\Property(
     *     type="string",
     *     property="birthDate",
     *     example="2020-05-11T14:00:00",
     *     nullable=false
     * )
     *
     * @ORM\Column(name="birthDate", type="datetime")
     * @Serializer\Groups({"user_default"})
     */
    private $birthDate;

    /**
     * @ORM\Column(type="array", length=255)
     * @Serializer\Groups({"user_default"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function __construct()
    {
        $this->uuid = Uuid\Uuid::uuid4();
        $this->dateCreation = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getUuid(): Uuid\UuidInterface
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(?DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
