<?php

namespace App\Controller\Species;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesAddController extends AbstractController
{
    /**
     * @Route("/species/add", name="species_add")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SpeciesAddController.php',
        ]);
    }
}
