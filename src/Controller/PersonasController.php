<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Repository\PersonaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonasController extends AbstractController
{
    /**
     * @Route("/personas", name="personas_get")
     */

    //Podemos usar servicios metiendolos en el constructor o por parametro de entrada
    //Tenemos la clase request con la que podemos acceder a los datos que nos mandan en la peticion
    public function list(Request $request, PersonaRepository $personaRepository)
    {
        $nombre = $request->get('nombre', 'Manu');
        $personas = $personaRepository->findAll();
        $personasAsArray = [];
        foreach ($personas as $persona) {
            $personasAsArray[] = [
                'id' => $persona->getId(),
                'nombre' => $persona->getNombre(),
                'image' => $persona->getImage()
            ];
        }
        $response = new JsonResponse();
        $response->setData(
            [
                'success' => true,
                'data' => $personasAsArray
            ]
        );
        return $response;
    }

    /**
     * @Route("/persona/create", name="create_book")
     */
    public function createPersona(Request $request, EntityManagerInterface $em)
    {
        $persona = new Persona();
        $response = new JsonResponse();
        $nombre = $request->get('nombre', null);
        if (empty($nombre)) {
            $response->setData([
                'success' => false,
                'error' => 'Title cannot be empty',
                'data' => null
            ]);
            return $response;
        }

        $persona->setNombre($nombre);
        //No lo manda a base de datos, le dice que lo tiene que controlar este objeto persona
        $em->persist($persona);
        //Ahora ya todos los objetos persistidos los mandamos a base de datos
        $em->flush();

        $response->setData(
            [
                'success' => true,
                'data' => [
                    [
                        'id' => $persona->getId(),
                        'nombre' => $persona->getNombre()
                    ]
                ]
            ]
        );
        return $response;
    }
}
