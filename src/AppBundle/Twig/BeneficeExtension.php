<?php

namespace AppBundle\Twig;

/**
 * Calcul du prix de revient des articles
 */
class BeneficeExtension extends \Twig_Extension
{

  public function getFilters()
  {
    return array(new \Twig_SimpleFilter('benefice', array($this, 'calculBenefice')));
  }

  public function calculBenefice($pr, $pv, $qte)
  {
    // Calcul du benefice de l'article
    $benefice = (($pv * $qte) - $pr);

    return $benefice;
  }

  public function getName()
  {
    return 'benefice_extension';
  }
}
