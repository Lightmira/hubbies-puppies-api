<?php
declare(strict_types=1);

namespace App\Manager\Animal;

use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AnimalViewManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Animal[]
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            /** @var Animal[] $animals */
            $animals = $this->entityManager->getRepository(Animal::class)->findAll();

            return $animals;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $animalUUID
     *
     * @return Animal
     * @throws Exception
     */
    public function get(string $animalUUID): Animal
    {
        try {
            /** @var Animal $animal */
            $animal = $this->entityManager->getRepository(Animal::class)->findOneBy([
                'uuid' => $animalUUID
            ]);

            return $animal;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
