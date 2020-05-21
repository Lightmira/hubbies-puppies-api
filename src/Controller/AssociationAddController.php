<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssociationAddController extends AbstractController
{
    /**
     * @Route("/association/add", name="association_add")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AssociationAddController.php',
        ]);
    }
}
