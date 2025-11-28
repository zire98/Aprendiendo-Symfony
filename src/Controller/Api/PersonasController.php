<?php

namespace App\Controller\Api;

use App\Entity\Persona;
use App\Form\Model\PersonaDto;
use App\Form\Type\PersonaFormType;
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

    public function postAction(EntityManagerInterface $em, Request $request)
    {
        $personaDto = new PersonaDto();
        $form = $this->createForm(PersonaFormType::class, $personaDto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $persona = new Persona();
            $persona->setNombre($personaDto->nombre);
            $em->persist($persona);
            $em->flush();
            return $persona;
        }
        return $form;
    }
}
