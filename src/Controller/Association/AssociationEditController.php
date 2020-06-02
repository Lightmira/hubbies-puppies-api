<?php

namespace App\Controller\Association;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssociationEditController extends AbstractController
{
    /**
     * @Route("/association/edit", name="association_edit")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AssociationEditController.php',
        ]);
    }
}