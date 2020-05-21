<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnimalDeleteController extends AbstractController
{
    /**
     * @Route("/animal/delete", name="animal_delete")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AnimalDeleteController.php',
        ]);
    }
}
