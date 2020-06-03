<?php

namespace App\Controller\Breed;

use App\Entity\Breed;
use App\Manager\Breed\BreedViewManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class BreedViewController extends AbstractFOSRestController
{
    private $breedViewManager;

    public function __construct(BreedViewManager $breedViewManager)
    {
        $this->breedViewManager = $breedViewManager;
    }

    /**
     * @OA\Get(
     *     path="/api/breeds/{breedUUID}",
     *     summary="Get a single Breed from uuid",
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
     *     }
     * )
     */

    /**
     * Get a breed
     *
     * @Rest\Get(
     *     path = "/api/breeds/{breedUUID}",
     *     name = "get_breed",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(string $breedUUID): Breed
    {
        try {
            /** @var Breed $breed */
            $breed = $this->breedViewManager->get($breedUUID);

            return $breed;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}
