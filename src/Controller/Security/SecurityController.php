<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Manager\User\UserAddManager;
use DateTime;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractFOSRestController
{
    private $userAddManager;

    public function __construct(UserAddManager $userAddManager)
    {
        $this->userAddManager = $userAddManager;
    }

    /**
     * @Route(name="login", path="/api/login_check")
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route(name="register", path="/api/register")
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $birthDate = new DateTime();

        try {
            $email = $request->get('email');
            $password = $request->get('password');
            $firstName = $request->get('firstName');
            $lastName = $request->get('lastName');

            $timestamp = strtotime($request->get('birthDate'));
            $birthDate->setTimestamp($timestamp);

            /** @var User $user */
            $user = $this->userAddManager->add(
                $email,
                $password,
                $firstName,
                $lastName,
                $birthDate
            );

            return new JsonResponse([
                "success" => $user->getUsername(). " has been registered!"
            ], 200);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
