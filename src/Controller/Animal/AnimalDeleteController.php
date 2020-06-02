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
     *     path="/animals/{animalId}",
     *     summary="Delete an Animal",
     *     tags={"Animal"},
     *     @OA\Parameter(
     *         ref="#/components/parameters/animalId",
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
     *     path = "/api/animals/{animalId}",
     *     name = "delete_animal",
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(Animal $animalId)
    {
        dd('ok');
        try {
            $this->animalEditManager->delete($animalId);

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
