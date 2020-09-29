<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Manager\Animal\AnimalViewManager;
use App\Services\Serializer\Serializer;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;

class AnimalViewController extends AbstractFOSRestController
{
    private $animalViewManager;
    private $serializer;

    public function __construct(
        AnimalViewManager $animalViewManager,
        Serializer $serializer
    ) {
        $this->animalViewManager = $animalViewManager;
        $this->serializer = $serializer;
    }

    /**
     * @OA\Get(
     *     path="/api/animals",
     *     summary="Get all Animals",
     *     tags={"Animal"},
     *     @OA\Response(
     *         response="200",
     *         description="Animals successfully displayed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         ref="#/components/schemas/Animal/properties/uuid",
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         ref="#/components/schemas/Animal/properties/name",
     *                     ),
     *                     @OA\Property(
     *                         property="gender",
     *                         ref="#/components/schemas/Animal/properties/gender",
     *                     ),
     *                     @OA\Property(
     *                         property="age",
     *                         ref="#/components/schemas/Animal/properties/age",
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         ref="#/components/schemas/Animal/properties/description",
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         ref="#/components/responses/animal_404",
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
     * Get all animals
     *
     * @Rest\Get(
     *     path = "/api/animals",
     *     name = "get_animals",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getAll(): JsonResponse
    {
        try {
            /** @var Animal[] $animals */
            $animals = $this->animalViewManager->getAll();
            $json = $this->serializer->serialize($animals, [
                'animal_default',
                'breed_default',
                'association_default',
                'species_default'
            ]);

            return new JsonResponse(['data' => json_decode($json)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/animals/{animalUUID}",
     *     summary="Get a single Animal from uuid",
     *     tags={"Animal"},
     *     @OA\Parameter(
     *         name="animalUUID",
     *         in="path",
     *         description="uuid of an animal",
     *         required=true,
     *         example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Animal successfully displayed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 ref="#/components/schemas/Animal/properties/uuid",
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Animal/properties/name",
     *             ),
     *             @OA\Property(
     *                 property="gender",
     *                 ref="#/components/schemas/Animal/properties/gender",
     *             ),
     *             @OA\Property(
     *                 property="age",
     *                 ref="#/components/schemas/Animal/properties/age",
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Animal/properties/description",
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         ref="#/components/responses/animal_404",
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
     * Get an animal
     *
     * @Rest\Get(
     *     path = "/api/animals/{animalUUID}",
     *     name = "get_animal",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(string $animalUUID): JsonResponse
    {
        try {
            /** @var Animal $animal */
            $animal = $this->animalViewManager->get($animalUUID);
            $json = $this->serializer->serialize($animal, [
                'animal_default',
                'breed_default',
                'association_default',
                'species_default'
            ]);

            return new JsonResponse(json_decode($json));
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }
}
