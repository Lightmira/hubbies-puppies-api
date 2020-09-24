<?php

namespace App\Controller\Breed;

use App\Entity\Breed;
use App\Manager\Breed\BreedAddManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BreedAddController extends AbstractFOSRestController
{
    private $breedAddManager;

    public function __construct(BreedAddManager $breedAddManager)
    {
        $this->breedAddManager = $breedAddManager;
    }

    /**
     * @OA\Post(
     *     path="/api/breeds",
     *     summary="Add a Breed",
     *     tags={"Breed"},
     *     @OA\RequestBody(
     *         description="Breed that will be added",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Breed/properties/label"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Breed successfully added",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="uuid",
     *                 ref="#/components/schemas/Breed/properties/uuid"
     *             ),
     *             @OA\Property(
     *                 property="label",
     *                 ref="#/components/schemas/Breed/properties/label"
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
     * Add a Breed
     *
     * @Rest\Post(
     *     path = "/api/breeds",
     *     name = "post_breed",
     * )
     *
     * @Rest\View(statusCode=201, serializerGroups={"breed_default"})
     */
    public function add(Request $request): Breed
    {
        try {
            $label = $request->get('label');

            /** @var Breed $breed */
            $breed = $this->breedAddManager->add($label);

            return $breed;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
