<?php
declare(strict_types=1);

namespace App\Manager\Animal;

use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AnimalAddManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(
        string $name,
        string $gender,
        int $age,
        string $description
    ): Animal
    {
        try {
            $animal = new Animal();
            $this->entityManager->persist($animal);

            $animal
                ->setName($name)
                ->setGender($gender)
                ->setAge($age)
                ->setDescription($description)
            ;

            $this->entityManager->flush();

            return $animal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}