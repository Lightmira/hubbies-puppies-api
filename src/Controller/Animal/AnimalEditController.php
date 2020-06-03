<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Manager\Animal\AnimalEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;

class AnimalEditController extends AbstractFOSRestController
{
    private $animalEditManager;

    public function __construct(AnimalEditManager $animalEditManager)
    {
        $this->animalEditManager = $animalEditManager;
    }

    /**
     * @OA\Put(
     *     path="/api/animals/{animalUUID}",
     *     summary="Edit an Animal",
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
     *     @OA\RequestBody(
     *         description="Animal that will be edited",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
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
     *     },
     * )
     */

    /**
     * Edit animal
     *
     * @Rest\Put(
     *     path = "/api/animals/{animalUUID}",
     *     name = "put_animal",
     * )
     *
     * @Rest\View(statusCode=200, serializerGroups={ "animal_default" })
     */
    public function edit(Request $request, string $animalUUID): Animal
    {
        try {
            $name            = $request->get('name');
            $gender          = $request->get('gender');
            $age             = $request->get('age');
            $description     = $request->get('description');
            $associationUUID = $request->get('association_id');
            $breedUUID       = $request->get('breed_id');
            $speciesUUID     = $request->get('species_id');

            /** @var Animal $animal */
            $animal = $this->animalEditManager->edit(
                $animalUUID,
                $name,
                $gender,
                $age,
                $description,
                $associationUUID,
                $breedUUID,
                $speciesUUID
            );

            return $animal;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
