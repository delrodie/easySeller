<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonnelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '25',
                      "placeholder" => "Le nom du personnel"
                  )
            ))
            ->add('prenoms', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '75',
                      "placeholder" => "Les prenoms du personnel"
                  )
            ))
            ->add('contact', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '75',
                      "placeholder" => "Le contact téléphonique"
                  )
            ))
            ->add('fonction', ChoiceType::class, array(
                  'choices' => array(
                    'CAISSE '  => 'CAISSE',
                    'GERANT '  => 'GERANT',
                    'GESTIONNAIRE DE STOCK '  => 'GESTIONNAIRE DE STOCK',
                  ),
                  'attr'  => array(
                      'class' => 'form-control',
                  )
            ))
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('user', null, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'placeholder' => 'Nom'
                  )
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personnel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personnel';
    }


}
