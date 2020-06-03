<?php

namespace App\Controller\Breed;

use App\Manager\Breed\BreedEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class BreedDeleteController extends AbstractFOSRestController
{
    private $breedEditManager;

    public function __construct(BreedEditManager $breedEditManager)
    {
        $this->breedEditManager = $breedEditManager;
    }

    /**
     * @OA\Delete(
     *     path="/api/breeds/{breedUUID}",
     *     summary="Delete an Breed",
     *     tags={"Breed"},
     *     @OA\Parameter(
     *         name="breedUUID",
     *         in="path",
     *         description="uuid of an breed",
     *         required=true,
     *         example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="no-content",
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
     * Delete an breed (soft delete)
     *
     * @Rest\Delete(
     *     path = "/api/breeds/{breedUUID}",
     *     name = "delete_breed",
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(string $breedUUID): void
    {
        try {
            $this->breedEditManager->delete($breedUUID);

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
