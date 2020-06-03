<?php

namespace App\Controller\Species;

use App\Manager\Species\SpeciesEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class SpeciesDeleteController extends AbstractFOSRestController
{
    private $speciesEditManager;

    public function __construct(SpeciesEditManager $speciesEditManager)
    {
        $this->speciesEditManager = $speciesEditManager;
    }

    /**
     * @OA\Delete(
     *     path="/api/species/{speciesUUID}",
     *     summary="Delete an Species",
     *     tags={"Species"},
     *     @OA\Parameter(
     *         name="speciesUUID",
     *         in="path",
     *         description="uuid of an species",
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
     *         ref="#/components/responses/species_404",
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
     * Delete an species (soft delete)
     *
     * @Rest\Delete(
     *     path = "/api/species/{speciesUUID}",
     *     name = "delete_species",
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(string $speciesUUID): void
    {
        try {
            $this->speciesEditManager->delete($speciesUUID);

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
