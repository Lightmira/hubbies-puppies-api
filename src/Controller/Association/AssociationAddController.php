<?php

namespace App\Controller\Association;

use App\Entity\Association;
use App\Manager\Association\AssociationAddManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AssociationAddController extends AbstractFOSRestController
{
    private $associationAddManager;

    public function __construct(AssociationAddManager $associationAddManager)
    {
        $this->associationAddManager = $associationAddManager;
    }

    /**
     * @OA\Post(
     *     path="/api/associations",
     *     summary="Add an Association",
     *     tags={"Association"},
     *     @OA\RequestBody(
     *         description="Association that will be added",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
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
     *         response="201",
     *         description="Association successfully added",
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
     * Add an Association
     *
     * @Rest\Post(
     *     path = "/api/associations",
     *     name = "post_association",
     * )
     *
     * @Rest\View(statusCode=201, serializerGroups={"association_default"})
     */
    public function add(Request $request): Association
    {
        try {
            $name        = $request->get('name');
            $logo        = $request->get('logo');
            $description = $request->get('description');
            $phone       = $request->get('phone');
            $cellphone   = $request->get('cellphone');
            $email       = $request->get('email');
            $address     = $request->get('address');

            $association = $this->associationAddManager->add(
                $name,
                $logo,
                $description,
                $phone,
                $cellphone,
                $email,
                $address
            );

            return $association;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
