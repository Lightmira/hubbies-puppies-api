<?php

namespace App\Controller\Association;

use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssociationViewController extends AbstractController
{
    /**
     * @Route("/association/view", name="association_view")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AssociationViewController.php',
        ]);
    }
}
