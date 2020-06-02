<?php

use OpenApi\Annotations as OA;

/**
 * Access those value with : #/components/parameters/{name}
 *
 * @OA\Parameter(
 *     name="associationId",
 *     in="path",
 *     description="uuid of an association",
 *     required=true,
 *     example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
 *     @OA\Schema(
 *         type="string"
 *     )
 * )
 */