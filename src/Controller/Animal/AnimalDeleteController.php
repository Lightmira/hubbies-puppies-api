<?php

namespace App\Controller\Animal;

use App\Entity\Animal;
use App\Manager\Animal\AnimalEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class AnimalDeleteController extends AbstractFOSRestController
{
    private $animalEditManager;

    public function __construct(AnimalEditManager $animalEditManager)
    {
        $this->animalEditManager = $animalEditManager;
    }

    /**
     * @OA\Delete(
     *     path="/animals/{animalUUID}",
     *     summary="Delete an Animal",
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
     *         response="204",
     *         description="no-content",
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
     * Delete an animal
     *
     * @Rest\Delete(
     *     path = "/api/animals/{animalUUID}",
     *     name = "delete_animal",
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(string $animalUUID)
    {
        try {
            $this->animalEditManager->delete($animalUUID);

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
