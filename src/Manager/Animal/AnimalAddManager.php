<?php
declare(strict_types=1);

namespace App\Manager\Animal;

use App\Entity\Animal;
use App\Entity\Association;
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
        string $description,
        int $associationUUID
    ): Animal
    {
        try {
            $animal = new Animal();
            $this->entityManager->persist($animal);

            /** @var Association $association */
            $association = $this->entityManager->getRepository(Association::class)->findOneBy([
                'uuid' => $associationUUID
            ]);

            $animal
                ->setName($name)
                ->setGender($gender)
                ->setAge($age)
                ->setDescription($description)
                ->setAssociation($association)
            ;

            $this->entityManager->flush();

            return $animal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}