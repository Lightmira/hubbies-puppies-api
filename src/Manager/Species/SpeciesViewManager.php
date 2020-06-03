<?php
declare(strict_types=1);

namespace App\Manager\Species;

use App\Entity\Species;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class SpeciesViewManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get one species data
     *
     * @param string $speciesUUID
     *
     * @return Species
     * @throws Exception
     */
    public function get(string $speciesUUID): Species
    {
        try {
            /** @var Species $species */
            $species = $this->entityManager->getRepository(Species::class)->findOneBy([
                'uuid' => $speciesUUID
            ]);

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}