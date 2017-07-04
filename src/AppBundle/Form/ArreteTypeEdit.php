<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ArreteTypeEdit extends AbstractType
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
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'dixmilleMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('cinqmilleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqmilleMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('deuxmilleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'deuxmilleMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('milleMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'milleMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('cinqcentMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqcentMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('deuxcentMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'deuxcentMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('centMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'centMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('cinquanteMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinquanteMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('vingtcinqMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'vingtcinqMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('dixMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'dixMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('cinqMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqMat()',
                      'readonly' => 'readonly',
                  ),
                  'required'  => false,
            ))
            ->add('totMat', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control facture-total billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'readonly' => 'readonly',
                      //"placeholder" => "Le nom de l'article"
                  ),
                  'required'  => false,
            ))
            //->add('recette')
            //->add('statut')
            //->add('publiePar')->add('modifiePar')->add('publieLe')->add('modifieLe')
            ->add('dixmilleSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '3',
                      'onBlur'  => 'dixmilleSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqmilleSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('deuxmilleSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('milleSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqcentSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('deuxcentSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('centSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('cinquanteSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('vingtcinqSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('dixSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('cinqSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'maxlength' => '2',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
            ->add('totSoir', TextType::class, array(
                  'attr'  => array(
                      'class' => 'form-control billetage input-seller-facture',
                      'autocomplete'  => 'off',
                      'onBlur'  => 'cinqSoir()',
                  ),
                  'required'  => false,
            ))
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
