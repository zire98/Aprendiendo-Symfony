<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PersonasController extends AbstractController
{
    /**
     * @Route("/personas/list", name="personas_list")
     */
    public function list()
    {
        $response = new JsonResponse();
        $response->setData(
            [
                'success' => true,
                'data' => [
                    [
                        'dni' => 16640700,
                        'nombre' => 'Eriz',
                        'apellidos' => 'Godrovich',
                        'municipio' => 'Fuenmayor'
                    ],
                    [
                        'dni' => 16640600,
                        'nombre' => 'Marta',
                        'apellidos' => 'Frances',
                        'municipio' => 'Lardero'
                    ]
                ]
            ]
        );
        return $response;
    }
}
