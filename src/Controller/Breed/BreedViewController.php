<?php

namespace App\Controller\Breed;

use App\Entity\Breed;
use App\Manager\Breed\BreedViewManager;
use App\Services\Serializer\Serializer;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;

class BreedViewController extends AbstractFOSRestController
{
    private $breedViewManager;
    private $serializer;

    public function __construct(
        BreedViewManager $breedViewManager,
        Serializer $serializer
    ) {
        $this->breedViewManager = $breedViewManager;
        $this->serializer = $serializer;
    }

    /**
     * @OA\Get(
     *     path="/api/breeds",
     *     summary="Get all Breeds",
     *     tags={"Breed"},
     *     @OA\Response(
     *         response="200",
     *         description="Breeds successfully displayed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         ref="#/components/schemas/Breed/properties/uuid",
     *                     ),
     *                     @OA\Property(
     *                         property="label",
     *                         ref="#/components/schemas/Breed/properties/label",
     *                     ),
     *                 ),
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
     * Get all breeds
     *
     * @Rest\Get(
     *     path = "/api/breeds",
     *     name = "get_breeds",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getAll(): JsonResponse
    {
        try {
            /** @var Breed[] $breeds */
            $breeds = $this->breedViewManager->getAll();
            $json = $this->serializer->serialize($breeds, ['breed_default']);

            return new JsonResponse(['data' => json_decode($json)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
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
     *         description="Breed successfully displayed",
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
    public function getOne(string $breedUUID): JsonResponse
    {
        try {
            /** @var Breed $breed */
            $breed = $this->breedViewManager->get($breedUUID);
            $json = $this->serializer->serialize($breed, ['breed_default']);

            return new JsonResponse(json_decode($json));
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}
