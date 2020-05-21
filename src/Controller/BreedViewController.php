<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BreedViewController extends AbstractController
{
    /**
     * @Route("/breed/view", name="breed_view")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BreedViewController.php',
        ]);
    }
}
