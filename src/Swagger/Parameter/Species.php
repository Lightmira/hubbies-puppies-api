<?php

use OpenApi\Annotations as OA;

/**
 * Access those value with : #/components/parameters/{name}
 *
 * @OA\Parameter(
 *     name="speciesId",
 *     in="path",
 *     description="uuid of a species",
 *     required=true,
 *     example="bd6bc279-2a0c-40cc-ae94-cb6c1697cf64",
 *     @OA\Schema(
 *         type="string"
 *     )
 * )
 */