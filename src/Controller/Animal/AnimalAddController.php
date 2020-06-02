<?php
declare(strict_types=1);

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Manager\Animal\AnimalAddManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnimalAddController extends AbstractFOSRestController
{
    private $animalAddManager;

    public function __construct(AnimalAddManager $animalAddManager)
    {
        $this->animalAddManager = $animalAddManager;
    }

    /**
     * @OA\Post(
     *     path="/api/animals",
     *     summary="Add an Animal",
     *     tags={"Animal"},
     *     @OA\RequestBody(
     *         description="Animal that will be added",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Animal/properties/name"
     *             ),
     *             @OA\Property(
     *                 property="gender",
     *                 ref="#/components/schemas/Animal/properties/gender"
     *             ),
     *             @OA\Property(
     *                 property="age",
     *                 ref="#/components/schemas/Animal/properties/age"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Animal/properties/description"
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Animal successfully added",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="uuid",
     *                 ref="#/components/schemas/Animal/properties/uuid"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 ref="#/components/schemas/Animal/properties/name"
     *             ),
     *             @OA\Property(
     *                 property="gender",
     *                 ref="#/components/schemas/Animal/properties/gender"
     *             ),
     *             @OA\Property(
     *                 property="age",
     *                 ref="#/components/schemas/Animal/properties/age"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 ref="#/components/schemas/Animal/properties/description"
     *             )
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
     * Add an Animal
     *
     * @Route("/api/animals", name="post_animal")
     *
     * @Rest\View(statusCode=201, serializerGroups={
     *     "animal_default",
     * })
     */
    public function add(Request $request): Animal
    {
        try {
            $name          = $request->get('name');
            $gender        = $request->get('gender');
            $age           = $request->get('age');
            $description   = $request->get('description');
            $associationId = $request->get('association_id');
            $breedId       = $request->get('breed_id');
            $speciesId     = $request->get('species_id');

            /** @var Animal $animal */
            $animal = $this->animalAddManager->add(
                $name,
                $gender,
                $age,
                $description,
                $associationId,
                $breedId,
                $speciesId
            );

            return $animal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
