<?php
declare(strict_types=1);

namespace App\Manager\Breed;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class BreedViewManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get one breed data
     *
     * @param string $breedUUID
     *
     * @return Breed
     * @throws Exception
     */
    public function get(string $breedUUID): Breed
    {
        try {
            /** @var Breed $breed */
            $breed = $this->entityManager->getRepository(Breed::class)->findOneBy([
                'uuid' => $breedUUID
            ]);

            return $breed;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}