<?php
declare(strict_types=1);

namespace App\Manager\Association;

use App\Entity\Association;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AssociationViewManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get one association data
     *
     * @param string $associationUUID
     *
     * @return Association
     * @throws Exception
     */
    public function get(string $associationUUID): Association
    {
        try {
            /** @var Association $association */
            $association = $this->entityManager->getRepository(Association::class)->findOneBy([
                'uuid' => $associationUUID
            ]);

            return $association;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}