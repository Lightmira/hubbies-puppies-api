<?php

namespace App\Controller\Animal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnimalEditController extends AbstractController
{
    /**
     * @Route("/animal/edit", name="animal_edit")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AnimalEditController.php',
        ]);
    }
}
