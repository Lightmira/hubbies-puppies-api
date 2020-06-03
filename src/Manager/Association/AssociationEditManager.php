<?php
declare(strict_types=1);

namespace App\Manager\Association;

use App\Entity\Association;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AssociationEditManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Edit an association
     *
     * @param string $associationUUID
     * @param string $name
     * @param string $logo
     * @param string $description
     * @param string $phone
     * @param string $cellphone
     * @param string $email
     * @param string $address
     *
     * @return Association
     * @throws Exception
     */
    public function edit(
        string $associationUUID,
        string $name,
        string $logo,
        string $description,
        string $phone,
        string $cellphone,
        string $email,
        string $address
    ): Association
    {
        try {
            /** @var Association $association */
            $association = $this->entityManager->getRepository(Association::class)->findOneBy([
                'uuid' => $associationUUID
            ]);

            $association
                ->setName($name)
                ->setLogo($logo)
                ->setDescription($description)
                ->setPhone($phone)
                ->setCellphone($cellphone)
                ->setEmail($email)
                ->setAddress($address)
                ->setDateUpdate(new DateTime());

            $this->entityManager->flush();

            return $association;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Delete an association
     *
     * @param string $associationUUID
     *
     * @return Association
     * @throws Exception
     */
    public function delete(string $associationUUID): Association
    {
        try {
            /** @var Association $association */
            $association = $this->entityManager->getRepository(Association::class)->findOneBy([
                'uuid' => $associationUUID
            ]);

            $now = new DateTime();

            $association
                ->setDateUpdate($now)
                ->setDeleted($now)
            ;

            $this->entityManager->flush();

            return $association;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}