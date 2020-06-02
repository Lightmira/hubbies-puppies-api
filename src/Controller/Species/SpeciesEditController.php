<?php

namespace App\Controller\Species;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesEditController extends AbstractController
{
    /**
     * @Route("/species/edit", name="species_edit")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SpeciesEditController.php',
        ]);
    }
}
