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
 *     url="http://dev.hubbies-puppies.fr",
 *     description="HUBBIES PUPPIES DEV API"
 * )
 *
 * @OA\Server(
 *     url="http://staging.hubbies-puppies.fr",
 *     description="HUBBIES PUPPIES STAGING PI"
 * )
 *
 * @OA\Server(
 *     url="http://preprod.hubbies-puppies.fr",
 *     description="HUBBIES PUPPIES PREPROD API"
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