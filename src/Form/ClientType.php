<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\TypeClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',
            EmailType::class,[
                'label' => 'Email',
                'attr' => [
                    'class'=>"form-control form-group",
                    'id'=> 'email'
                ]
                
                ] )
            ->add('telephone')
            ->add('adresse')
            ->add('nom')
            ->add('prenom')
            ->add('salaire' ,NumberType::class)
            ->add('nomEntreprise')
            ->add('typeClient')
            ->add('employeur')
            ->add('Envoyer', SubmitType::class)
            ->add('Annuler', ResetType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
