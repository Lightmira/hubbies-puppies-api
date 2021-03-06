<?php

use OpenApi\Annotations as OA;

/**
 * Access those value with : #/components/responses/{response}
 *
 * @OA\Response(
 *     response="association_404",
 *     description="Association not found",
 *     @OA\JsonContent(type="object",
 *         @OA\Property(property="code", example="404"),
 *         @OA\Property(property="message", example="associationNotFound"),
 *     )
 * )
 *
 */