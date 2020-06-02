<?php

namespace App\Controller\Association;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssociationDeleteController extends AbstractController
{
    /**
     * @Route("/association/delete", name="association_delete")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AssociationDeleteController.php',
        ]);
    }
}
