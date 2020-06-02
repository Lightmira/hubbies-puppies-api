<?php
declare(strict_types=1);

namespace App\Manager\Animal;

use App\Entity\Animal;
use App\Entity\Association;
use App\Entity\Breed;
use App\Entity\Species;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AnimalAddManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Create a new animal
     *
     * @param string $name
     * @param string $gender
     * @param int    $age
     * @param string $description
     * @param string $associationUUID
     * @param string $breedUUID
     * @param string $speciesUUID
     *
     * @return Animal
     * @throws Exception
     */
    public function add(
        string $name,
        string $gender,
        int    $age,
        string $description,
        string $associationUUID,
        string $breedUUID,
        string $speciesUUID
    ): Animal
    {
        try {
            $animal = new Animal();
            $this->entityManager->persist($animal);

            /** @var Association $association */
            $association = $this->entityManager->getRepository(Association::class)->findOneBy([
                'uuid' => $associationUUID
            ]);

            /** @var Breed $breed */
            $breed = $this->entityManager->getRepository(Breed::class)->findOneBy([
                'uuid' => $breedUUID
            ]);

            /** @var Species $species */
            $species = $this->entityManager->getRepository(Species::class)->findOneBy([
                'uuid' => $speciesUUID
            ]);

            $animal
                ->setName($name)
                ->setGender($gender)
                ->setAge($age)
                ->setDescription($description)
                ->setAssociation($association)
                ->setBreed($breed)
                ->setSpecies($species)
            ;

            $this->entityManager->flush();

            return $animal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}