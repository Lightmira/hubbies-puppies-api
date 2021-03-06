<?php
declare(strict_types=1);

namespace App\Manager\Breed;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class BreedAddManager
{
    private $entityManager;

    /**
     * BreedAddManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $label
     *
     * @return Breed
     * @throws Exception
     */
    public function add(string $label): Breed
    {
        try {
            $breed = new Breed();
            $this->entityManager->persist($breed);

            $breed->setLabel($label);
            $this->entityManager->flush();

            return $breed;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
