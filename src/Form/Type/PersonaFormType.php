<?php

namespace App\Form\Type;

use App\Entity\Persona;
use App\Form\Model\PersonaDto;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('base64Image', TextType::class);
    }

    // especificamos la clase a la que se asocia el formulario
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonaDto::class
        ]);
    }

    // Con estos metodos devolvemos un string vacio para no tener que especificar nonmbre del form
    public function getBlockPrefix()
    {
        return '';
    }

    public function getName()
    {
        return '';
    }
}
