<?php

namespace App\Controller\Association;

use App\Entity\Association;
use App\Manager\Association\AssociationEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class AssociationEditController extends AbstractFOSRestController
{
    private $associationEditManager;

    public function __construct(AssociationEditManager $associationEditManager)
    {
        $this->associationEditManager = $associationEditManager;
    }

    /**
     * @OA\Put(
     *     path="/api/associations/{associationUUID}",
     *     summary="Edit an Association",
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
     *     @OA\RequestBody(
     *         description="Association that will be edited",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Association/properties/name",
     *             ),
     *             @OA\Property(
     *                 property="logo",
     *                 ref="#/components/schemas/Association/properties/logo",
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Association/properties/description",
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 ref="#/components/schemas/Association/properties/phone",
     *             ),
     *             @OA\Property(
     *                 property="cellphone",
     *                 ref="#/components/schemas/Association/properties/cellphone",
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 ref="#/components/schemas/Association/properties/email",
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 ref="#/components/schemas/Association/properties/address",
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Association successfully edited",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 ref="#/components/schemas/Association/properties/uuid",
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Association/properties/name",
     *             ),
     *             @OA\Property(
     *                 property="logo",
     *                 ref="#/components/schemas/Association/properties/logo",
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Association/properties/description",
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 ref="#/components/schemas/Association/properties/phone",
     *             ),
     *             @OA\Property(
     *                 property="cellphone",
     *                 ref="#/components/schemas/Association/properties/cellphone",
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 ref="#/components/schemas/Association/properties/email",
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 ref="#/components/schemas/Association/properties/address",
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
     *     },
     * )
     */

    /**
     * Edit Association
     *
     * @Rest\Put(
     *     path = "/api/associations/{associationUUID}",
     *     name = "put_association",
     * )
     *
     * @Rest\View(statusCode=200, serializerGroups={ "association_default" })
     */
    public function edit(Request $request, string $associationUUID): Association
    {
        try {
            $name        = $request->get('name');
            $logo        = $request->get('logo');
            $description = $request->get('description');
            $phone       = $request->get('phone');
            $cellphone   = $request->get('cellphone');
            $email       = $request->get('email');
            $address     = $request->get('address');

            /** @var Association $association */
            $association = $this->associationEditManager->edit(
                $associationUUID,
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
