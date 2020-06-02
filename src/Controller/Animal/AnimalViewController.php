<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Manager\Animal\AnimalViewManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class AnimalViewController extends AbstractFOSRestController
{
    private $animalViewManager;

    public function __construct(AnimalViewManager $animalViewManager)
    {
        $this->animalViewManager = $animalViewManager;
    }

    /**
     * @OA\Get(
     *     path="/animals/{animalId}",
     *     summary="Get a single Animal from uuid",
     *     tags={"Animal"},
     *     @OA\Parameter(
     *         ref="#/components/parameters/animalId",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Animal successfully edited",
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
     *     path = "/animals/{animalId}",
     *     name = "get_animal",
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(Request $request, Animal $animalId)
    {
//        try {
//            $animal = $this->animalViewManager->get($animalId);
//
//            return $this->serializer->jsonResponse($project, $serializerGroups);
//        } catch (Exception $e) {
//            throw new Exception($e->getMessage(), $e->getCode());
//        }

    }
}
