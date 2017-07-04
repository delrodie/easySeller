<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ArreteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user = $options['user'];

        $user = $this->user;

        $builder
            ->add('dixmilleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'dixmilleMat()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqmilleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqmilleMat()',
                  ),
                  'required'  => false,
            ))
            ->add('deuxmilleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'deuxmilleMat()',
                  ),
                  'required'  => false,
            ))
            ->add('milleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'milleMat()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqcentMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqcentMat()',
                  ),
                  'required'  => false,
            ))
            ->add('deuxcentMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'deuxcentMat()',
                  ),
                  'required'  => false,
            ))
            ->add('centMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'centMat()',
                  ),
                  'required'  => false,
            ))
            ->add('cinquanteMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinquanteMat()',
                  ),
                  'required'  => false,
            ))
            ->add('vingtcinqMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'vingtcinqMat()',
                  ),
                  'required'  => false,
            ))
            ->add('dixMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'dixMat()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqMat()',
                  ),
                  'required'  => false,
            ))
            ->add('totMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control facture-total billetage',
                      'autocomplete'  => 'off',
                      'readonly' => 'readonly',
                      //"placeholder" => "Le nom de l'article"
                  ),
                  'required'  => false,
            ))
            //->add('recette')
            //->add('statut')
            //->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            //->add('dixmilleSoir')->add('cinqmilleSoir')->add('deuxmilleSoir')->add('milleSoir')
            //->add('cinqcentSoir')->add('deuxcentSoir')->add('centSoir')->add('cinquanteSoir')
            //->add('vingtcinqSoir')->add('dixSoir')->add('cinqSoir')->add('totSoir')
            ->add('caissiere', EntityType::class, array(
                  'attr'  => array(
                      'class' => 'form-control'
                  ),
                'class' => 'AppBundle:User',
                'query_builder' =>  function(EntityRepository $er) use($user){
                        return $er->getCaissiere($user);
                  },
                  'choice_label'  => 'username',
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Arrete',
            'user'      => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_arrete';
    }


}
