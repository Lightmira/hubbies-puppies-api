<?php

namespace App\Controller\Association;

use App\Entity\Association;
use App\Manager\Association\AssociationViewManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class AssociationViewController extends AbstractFOSRestController
{
    private $associationViewManager;

    public function __construct(AssociationViewManager $associationViewManager)
    {
        $this->associationViewManager = $associationViewManager;
    }

    /**
     * @OA\Get(
     *     path="/api/associations",
     *     summary="Get all Associations",
     *     tags={"Association"},
     *     @OA\Response(
     *         response="200",
     *         description="Association successfully displayed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="uuid",
     *                         ref="#/components/schemas/Association/properties/uuid"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         ref="#/components/schemas/Association/properties/name"
     *                     ),
     *                     @OA\Property(
     *                         property="logo",
     *                         ref="#/components/schemas/Association/properties/logo"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         ref="#/components/schemas/Association/properties/description"
     *                     ),
     *                     @OA\Property(
     *                         property="phone",
     *                         ref="#/components/schemas/Association/properties/phone"
     *                     ),
     *                     @OA\Property(
     *                         property="cellphone",
     *                         ref="#/components/schemas/Association/properties/cellphone"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         ref="#/components/schemas/Association/properties/email"
     *                     ),
     *                     @OA\Property(
     *                         property="address",
     *                         ref="#/components/schemas/Association/properties/address"
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         ref="#/components/responses/association_404",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         ref="#/components/responses/error_500",
     *     ),
     *     security={
     *         {
     *             "bearer": {}
     *         }
     *     }
     * )
     */
    /**
     * Get an association
     *
     * @Rest\Get(
     *     path = "/api/associations",
     *     name = "get_associations",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getAll(): array
    {
        try {
            /** @var Association[] $associations */
            $associations = $this->associationViewManager->getAll();

            return ['data' => $associations];
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

    /**
     * @OA\Get(
     *     path="/api/associations/{associationUUID}",
     *     summary="Get a single Association from uuid",
     *     tags={"Association"},
     *     @OA\Parameter(
     *         name="associationUUID",
     *         in="path",
     *         description="uuid of an association",
     *         required=true,
     *         example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Association successfully edited",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="uuid",
     *                 ref="#/components/schemas/Association/properties/uuid"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Association/properties/name"
     *             ),
     *             @OA\Property(
     *                 property="logo",
     *                 ref="#/components/schemas/Association/properties/logo"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Association/properties/description"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 ref="#/components/schemas/Association/properties/phone"
     *             ),
     *             @OA\Property(
     *                 property="cellphone",
     *                 ref="#/components/schemas/Association/properties/cellphone"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 ref="#/components/schemas/Association/properties/email"
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 ref="#/components/schemas/Association/properties/address"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         ref="#/components/responses/association_404",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         ref="#/components/responses/error_500",
     *     ),
     *     security={
     *         {
     *             "bearer": {}
     *         }
     *     }
     * )
     */
    /**
     * Get an association
     *
     * @Rest\Get(
     *     path = "/api/associations/{associationUUID}",
     *     name = "get_association",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(string $associationUUID): Association
    {
        try {
            /** @var Association $association */
            $association = $this->associationViewManager->get($associationUUID);

            return $association;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}
