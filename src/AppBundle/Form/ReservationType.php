<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('startDate',DateType::HTML5_FORMAT,['label'=>'Date début'])
            ->add('enddate',DateType::HTML5_FORMAT,['label'=>'Date fin'])
            ->add('nbrperson',IntegerType::class,['label'=>'Nombre de personnes'])
            ->add('email', RepeatedType::class,['type'=> EmailType::class,
                'first_options'=>['label'=>'Saisir Email','required'=>true],'second_options'=>['label'=>'Confirmer l\'email'],'invalid_message'=>'La saisie doit être identique'])
            ->add('submit',SubmitType::class,
                ['label'=>'Valider','attr'=>['class'=>'btn btn-primary']]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_reservation';
    }


}
