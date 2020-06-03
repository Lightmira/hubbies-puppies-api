<?php
declare(strict_types=1);

namespace App\Manager\Species;

use App\Entity\Species;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class SpeciesEditManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Edit a species
     *
     * @param string $speciesUUID
     * @param string $label
     *
     * @return Species
     * @throws Exception
     */
    public function edit(
        string $speciesUUID,
        string $label
    ): Species
    {
        try {
            /** @var Species $species */
            $species = $this->entityManager->getRepository(Species::class)->findOneBy([
                'uuid' => $speciesUUID
            ]);

            $species
                ->setLabel($label)
                ->setDateUpdate(new DateTime());

            $this->entityManager->flush();

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete a species
     *
     * @param string $speciesUUID
     *
     * @return Species
     * @throws Exception
     */
    public function delete(string $speciesUUID): Species
    {
        try {
            /** @var Species $species */
            $species = $this->entityManager->getRepository(Species::class)->findOneBy([
                'uuid' => $speciesUUID
            ]);

            $now = new DateTime();

            $species
                ->setDateUpdate($now)
                ->setDeleted($now)
            ;

            $this->entityManager->flush();

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}