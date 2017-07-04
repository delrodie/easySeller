<?php

namespace AppBundle\Twig;

/**
 * Format du CFA par separateur de millle
 */
class MonnaieExtension extends \Twig_Extension
{

  public function getFilters()
  {
    return array(new \Twig_SimpleFilter('monnaie', array($this, 'monnaieFormat')));
  }

  public function monnaieFormat($number, $decimal = 0, $decSeparateur = ',', $milleSeparateur = '.')
  {
    $monnaie = number_format($number, $decimal, $decSeparateur, $milleSeparateur);

    return $monnaie;
  }

  public function getName()
  {
    return 'app_extension';
  }
}
