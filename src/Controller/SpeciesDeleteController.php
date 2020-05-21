<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesDeleteController extends AbstractController
{
    /**
     * @Route("/species/delete", name="species_delete")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SpeciesDeleteController.php',
        ]);
    }
}
