<?php

namespace App\Controller\Species;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesViewController extends AbstractController
{
    /**
     * @Route("/species/view", name="species_view")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SpeciesViewController.php',
        ]);
    }
}
