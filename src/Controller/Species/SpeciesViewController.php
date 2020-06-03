<?php

namespace App\Controller\Species;

use App\Entity\Species;
use App\Manager\Species\SpeciesViewManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class SpeciesViewController extends AbstractFOSRestController
{
    private $speciesViewManager;

    public function __construct(SpeciesViewManager $speciesViewManager)
    {
        $this->speciesViewManager = $speciesViewManager;
    }

    /**
     * @OA\Get(
     *     path="/api/species/{speciesUUID}",
     *     summary="Get a single Species from uuid",
     *     tags={"Species"},
     *     @OA\Parameter(
     *         name="speciesUUID",
     *         in="path",
     *         description="uuid of a species",
     *         required=true,
     *         example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Species successfully edited",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 ref="#/components/schemas/Species/properties/uuid",
     *             ),
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Species/properties/label",
     *             ),
     *         ),
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
     *     }
     * )
     */

    /**
     * Get a species
     *
     * @Rest\Get(
     *     path = "/api/species/{speciesUUID}",
     *     name = "get_species",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(string $speciesUUID): Species
    {
        try {
            /** @var Species $species */
            $species = $this->speciesViewManager->get($speciesUUID);

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}
