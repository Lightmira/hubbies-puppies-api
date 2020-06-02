<?php
declare(strict_types=1);

namespace App\Manager\Association;

use App\Entity\Association;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class AssociationAddManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(
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
            $association = new Association();
            $this->entityManager->persist($association);

            $association
                ->setName($name)
                ->setLogo($logo)
                ->setDescription($description)
                ->setPhone($phone)
                ->setCellphone($cellphone)
                ->setEmail($email)
                ->setAddress($address)
            ;

            $this->entityManager->flush();

            return $association;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}