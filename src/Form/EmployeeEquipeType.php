<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Equipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class   EmployeeEquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id'//,
               // EntityType::class,
              //  [
              //     'class' => Employee::class,
               //     'choice_label' => 'id'
              //  ])
        )
            ->add('equipeId'//,
                //EntityType::class,
              //  [
               //     'class' => Equipe::class,
                //    'choice_label' => 'idEquipe'
              //  ]);
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
