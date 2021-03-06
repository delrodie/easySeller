<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProduitType extends AbstractType
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
                      'maxlength' => '75',
                      "placeholder" => "Le nom de l'article"
                  )
            ))
            //->add('code')
            ->add('model', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      'maxlength' => '25',
                      "placeholder" => "Le numero de model"
                  )
            ))
            ->add('description', TextareaType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                       "rows" => "5"
                  ),
                  'required'  => false
            ))
            //->add('pa')
            ->add('pv', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      "placeholder" => "Prix de vente"
                  )
            ))
            ->add('remise', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control',
                      'autocomplete'  => 'off',
                      "placeholder" => "Remise maximum sans %"
                  ),
                  'required'  => false
            ))
            ->add('file', FileType::class, array(
              'label' => "Telecharger l'image",
              'required' => false,
          ))
            //->add('qte')->add('statut')
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('categorie', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'select-categorie form-control'
                  ),
                'class' => 'AppBundle:Categorie'
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_produit';
    }


}
