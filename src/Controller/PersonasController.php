<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonasController extends AbstractController
{
    /**
     * @Route("/personas/list", name="personas_list")
     */

    //Podemos usar servicios metiendolos en el constructor o por parametro de entrada
    //Tenemos la clase request con la que podemos acceder a los datos que nos mandan en la peticion
    public function list(Request $request, LoggerInterface $logger)
    {
        $nombre = $request->get('nombre', 'Manu');
        $logger->info('List action called');
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
                    ],
                    [
                        'dni' => 16640500,
                        'nombre' => $nombre,
                        'apellidos' => 'Olave',
                        'municipio' => 'Vitoria'
                    ]
                ]
            ]
        );
        return $response;
    }
}
