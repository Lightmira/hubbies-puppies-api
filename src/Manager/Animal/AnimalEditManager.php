<?php
declare(strict_types=1);

namespace App\Manager\Animal;

use App\Entity\Animal;
use App\Entity\Association;
use App\Entity\Breed;
use App\Entity\Species;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AnimalEditManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Edit an animal
     *
     * @param Animal      $animalId
     * @param string      $name
     * @param string      $gender
     * @param int         $age
     * @param string      $description
     * @param Association $association
     * @param Breed       $breed
     * @param Species     $species
     *
     * @return Animal
     * @throws Exception
     */
    public function edit(
        Animal $animalId,
        string $name,
        string $gender,
        int $age,
        string $description,
        Association $association,
        Breed $breed,
        Species $species
    ) {
        try {
            /** @var Animal $animal */
            $animal = $this->entityManager->getRepository(Animal::class)->findOneBy([
                'uuid' => $animalId
            ]);

            $animal
                ->setName($name)
                ->setGender($gender)
                ->setAge($age)
                ->setDescription($description)
                ->setAssociation($association)
                ->setBreed($breed)
                ->setSpecies($species)
                ->setDateUpdate(new DateTime());

            $this->entityManager->flush();

            return $animal;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete an animal
     *
     * @param string $animalUUID
     *
     * @return Animal
     * @throws Exception
     */
    public function delete(string $animalUUID)
    {
        try {
            /** @var Animal $animal */
            $animal = $this->entityManager->getRepository(Animal::class)->findOneBy([
                'uuid' => $animalUUID
            ]);
            $animal->setDeleted(new DateTime());

            $this->entityManager->flush();

            return $animal;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}