<?php

namespace App\Controller\Breed;

use App\Entity\Breed;
use App\Manager\Breed\BreedEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class BreedEditController extends AbstractFOSRestController
{
    private $breedEditManager;

    public function __construct(BreedEditManager $breedEditManager)
    {
        $this->breedEditManager = $breedEditManager;
    }

    /**
     * @OA\Put(
     *     path="/api/breeds/{breedUUID}",
     *     summary="Edit a Breed",
     *     tags={"Breed"},
     *     @OA\Parameter(
     *         name="breedUUID",
     *         in="path",
     *         description="uuid of a breed",
     *         required=true,
     *         example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Breed that will be edited",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Breed/properties/label",
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Breed successfully edited",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 ref="#/components/schemas/Breed/properties/uuid",
     *             ),
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Breed/properties/label",
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         ref="#/components/responses/breed_404",
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
     * Edit breed
     *
     * @Rest\Put(
     *     path = "/api/breeds/{breedUUID}",
     *     name = "put_breed",
     * )
     *
     * @Rest\View(statusCode=200, serializerGroups={"breed_default"})
     */
    public function edit(Request $request, string $breedUUID): Breed
    {
        try {
            $label = $request->get('label');

            /** @var Breed $breed */
            $breed = $this->breedEditManager->edit(
                $breedUUID,
                $label
            );

            return $breed;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
