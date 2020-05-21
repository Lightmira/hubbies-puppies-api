<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Animal;
use App\Manager\Animal\AnimalAddManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnimalAddController extends AbstractController
{
    private $animalAddManager;

    public function __construct(AnimalAddManager $animalAddManager)
    {
        $this->animalAddManager = $animalAddManager;
    }

    /**
     * @Route("/animals", name="post_animal")
     */
    public function add(Request $request): Animal
    {
        dd($request);
        try {
            $name        = $request->get('name');
            $gender      = $request->get('gender');
            $age         = $request->get('age');
            $description = $request->get('description');

            $animal = $this->animalAddManager->add(
                $name,
                $gender,
                $age,
                $description
            );

            return $animal;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
