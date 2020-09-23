<?php
declare(strict_types=1);

namespace App\Manager\User;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAddManager
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param string   $email
     * @param string   $password
     * @param string   $firstName
     * @param string   $lastName
     * @param DateTime $birthDate
     *
     * @return User
     * @throws Exception
     */
    public function add(
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        DateTime $birthDate
    ): User
    {
        try {
            $user = new User();
            $user
                ->setEmail($email)
                ->setPassword($this->passwordEncoder->encodePassword($user, $password))
                ->setFirstName($firstName)
                ->setLastName($lastName)
                ->setBirthDate($birthDate);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return $user;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
