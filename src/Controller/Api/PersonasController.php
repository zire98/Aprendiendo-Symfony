<?php

namespace App\Controller\Api;

use App\Entity\Persona;
use App\Repository\PersonaRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class PersonasController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/personas")
     * @Rest\View(serializerGroups={"persona"}, serializerEnableMaxDepthChecks=true)
     */

    public function getAction(PersonaRepository $personaRepository)
    {
        return $personaRepository->findAll();
    }

    /**
     * @Rest\Post(path="/personas")
     * @Rest\View(serializerGroups={"persona"}, serializerEnableMaxDepthChecks=true)
     */

    public function postAction(EntityManagerInterface $em)
    {
        $persona = new Persona();
        $persona->setNombre('Installing FOS Rest Bundle');
        $em->persist($persona);
        $em->flush();

        return $persona;
    }
}
