<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BreedDeleteController extends AbstractController
{
    /**
     * @Route("/breed/delete", name="breed_delete")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BreedDeleteController.php',
        ]);
    }
}
