<?php
declare(strict_types=1);

use OpenApi\Annotations as OA;
/**
 * @OA\Info(
 *     title="HUBBIES PUPPIES API",
 *     version="1.0"
 * )
 *
 * @OA\Server(
 *     url="http://api.hubbies-puppies.com:9082",
 *     description="HUBBIES PUPPIES DEV API"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearer",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 *
 **/