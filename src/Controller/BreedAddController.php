<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BreedAddController extends AbstractController
{
    /**
     * @Route("/breed/add", name="breed_add")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BreedAddController.php',
        ]);
    }
}
