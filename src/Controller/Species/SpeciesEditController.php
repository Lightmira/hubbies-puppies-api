<?php

namespace App\Controller\Species;

use App\Entity\Species;
use App\Manager\Species\SpeciesEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class SpeciesEditController extends AbstractFOSRestController
{
    private $speciesEditManager;

    public function __construct(SpeciesEditManager $speciesEditManager)
    {
        $this->speciesEditManager = $speciesEditManager;
    }

    /**
     * @OA\Put(
     *     path="/api/species/{speciesUUID}",
     *     summary="Edit a Species",
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
     *     @OA\RequestBody(
     *         description="Species that will be edited",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Species/properties/label",
     *             ),
     *         ),
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
     *     },
     * )
     */

    /**
     * Edit species
     *
     * @Rest\Put(
     *     path = "/api/species/{speciesUUID}",
     *     name = "put_species",
     * )
     *
     * @Rest\View(statusCode=200, serializerGroups={"species_default"})
     */
    public function edit(Request $request, string $speciesUUID): Species
    {
        try {
            $label = $request->get('label');

            /** @var Species $species */
            $species = $this->speciesEditManager->edit(
                $speciesUUID,
                $label
            );

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
