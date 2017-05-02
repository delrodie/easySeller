<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class FactureSaveType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('client')->add('tht')->add('tva')->add('mttc')
            ->add('remise', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control input-seller-facture',
                      'autocomplete'  => 'off',
                      'onblur'  => 'remise()',
                  ),
                  'required' => false,
            ))
            ->add('nap', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control input-seller-facture-monnaie',
                      'autocomplete'  => 'off',
                      'readonly' => 'readonly',
                  )
            ))
            ->add('verse', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control input-seller-facture',
                      'autocomplete'  => 'off',
                      'onblur'  => 'verse()',
                      'required' => true
                  )
            ))
            //->add('monnaie')
            //->add('statut')
            //->add('slug')->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Facture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_facture';
    }


}
