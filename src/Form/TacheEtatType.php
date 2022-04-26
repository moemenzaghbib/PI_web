<?php


namespace App\Form;

use App\Entity\Employee;
use App\Entity\Service;
use App\Entity\Tache;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TacheEtatType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {               $DONE="DONE";
                    $NDONE="NOT DONE";

        $builder
            ->add('etatTache', ChoiceType::class, [
                'choices'  => [
                    'DONE' => 'DONE',
                    'NOT DONE' => 'NOT DONE',
                    ]
                ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
