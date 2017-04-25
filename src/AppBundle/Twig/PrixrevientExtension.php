<?php

namespace AppBundle\Twig;

/**
 * Calcul du prix de revient des articles
 */
class PrixrevientExtension extends \Twig_Extension
{

  public function getFilters()
  {
    return array(new \Twig_SimpleFilter('prixrevient', array($this, 'calculPR')));
  }

  public function calculPR($montantFacture, $paArticle, $fret)
  {
    // Calcul du % des parts de l'article dans le montant total de la facture
    $percentage = round((($paArticle * 100) / $montantFacture),0);

    // Calcul du % des parts de l'article dans le fret de l'approvisionnement
    $fretArticle = round((($fret * $percentage) / 100),0);

    // Calcul du prix de revient de l'article
    $prixrevient = $paArticle + $fretArticle;

    return $prixrevient;
  }

  public function getName()
  {
    return 'prixrevient_extension';
  }
}
