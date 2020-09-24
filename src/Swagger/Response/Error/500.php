<?php

use OpenApi\Annotations as OA;

/**
 * Access those value with : #/components/responses/{response}
 *
 * @OA\Response(
 *     response="error_500",
 *     description="Error: Internal Server Error",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="code", example="500"),
 *         @OA\Property(property="message", example="systemError"),
 *     )
 * )
 *
 */