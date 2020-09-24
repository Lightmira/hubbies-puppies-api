<?php
declare(strict_types=1);

namespace App\Manager\Breed;

use App\Entity\Breed;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class BreedEditManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $breedUUID
     * @param string $label
     *
     * @return Breed
     * @throws Exception
     */
    public function edit(
        string $breedUUID,
        string $label
    ): Breed
    {
        try {
            /** @var Breed $breed */
            $breed = $this->entityManager->getRepository(Breed::class)->findOneBy([
                'uuid' => $breedUUID
            ]);

            $breed
                ->setLabel($label)
                ->setDateUpdate(new DateTime());

            $this->entityManager->flush();

            return $breed;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $breedUUID
     *
     * @throws Exception
     */
    public function delete(string $breedUUID): void
    {
        try {
            /** @var Breed $breed */
            $breed = $this->entityManager->getRepository(Breed::class)->findOneBy([
                'uuid' => $breedUUID
            ]);

            $now = new DateTime();

            $breed
                ->setDateUpdate($now)
                ->setDeleted($now)
            ;

            $this->entityManager->flush();

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
