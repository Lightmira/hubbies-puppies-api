<?php

namespace App\Controller\Association;

use App\Manager\Association\AssociationEditManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

class AssociationDeleteController extends AbstractFOSRestController
{
    private $associationEditManager;

    public function __construct(AssociationEditManager $associationEditManager)
    {
        $this->associationEditManager = $associationEditManager;
    }

    /**
     * @OA\Delete(
     *     path="/api/association/{associationUUID}",
     *     summary="Delete an Association",
     *     tags={"Association"},
     *     @OA\Parameter(
     *         name="associationUUID",
     *         in="path",
     *         description="uuid of an association",
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
     *         ref="#/components/responses/association_404",
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
     * Delete an association (soft delete)
     *
     * @Rest\Delete(
     *     path = "/api/associations/{associationUUID}",
     *     name = "delete_association",
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(string $associationUUID): void
    {
        try {
            $this->associationEditManager->delete($associationUUID);

            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
