<?php

namespace App\Controller\Animal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnimalViewController extends AbstractController
{
    /**
     * @Route("/animal/view", name="animal_view")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AnimalViewController.php',
        ]);
    }
}
