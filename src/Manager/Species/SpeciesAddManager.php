<?php
declare(strict_types=1);

namespace App\Manager\Species;

use App\Entity\Species;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class SpeciesAddManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(string $label): Species
    {
        try {
            $species = new Species();
            $this->entityManager->persist($species);

            $species->setLabel($label);

            $this->entityManager->flush();

            return $species;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}