<?php

namespace App\Controller\Breed;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BreedEditController extends AbstractController
{
    /**
     * @Route("/breed/edit", name="breed_edit")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BreedEditController.php',
        ]);
    }
}
