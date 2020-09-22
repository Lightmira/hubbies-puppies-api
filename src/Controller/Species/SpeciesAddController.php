<?php

namespace App\Controller\Species;

use App\Entity\Species;
use App\Manager\Species\SpeciesAddManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesAddController extends AbstractFOSRestController
{
    private $speciesAddManager;

    public function __construct(SpeciesAddManager $speciesAddManager)
    {
        $this->speciesAddManager = $speciesAddManager;
    }

    /**
     * @OA\Post(
     *     path="/api/species",
     *     summary="Add a Species",
     *     tags={"Species"},
     *     @OA\RequestBody(
     *         description="Species that will be added",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Species/properties/label"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Species successfully added",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="uuid",
     *                 ref="#/components/schemas/Species/properties/uuid"
     *             ),
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Species/properties/label"
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
     * Add a Species
     *
     * @Rest\Post(
     *     path = "/api/species",
     *     name = "post_species",
     * )
     *
     * @Rest\View(statusCode=201, serializerGroups={"species_default"})
     */
    public function add(Request $request): Species
    {
        try {
            $label = $request->get('label');

            /** @var Species $species */
            $species = $this->speciesAddManager->add($label);

            return $species;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
