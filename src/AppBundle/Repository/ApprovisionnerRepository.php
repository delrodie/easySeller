<?php

namespace AppBundle\Repository;

/**
 * ApprovisionnerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApprovisionnerRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Calcul du prix de revient de l'article concerné
     *
     * Author: Delrodie AMOIKON
     * Date: 26/04/2017 02:19
     * Version: v1.0
     */
     public function calculPrixRevient($montantFacture, $fret, $paArticle)
     {
       // Calcul du % des parts de l'article dans le montant total de la facture
       $percentage = round((($paArticle * 100) / $montantFacture),0);

       // Calcul du % des parts de l'article dans le fret de l'approvisionnement
       $fretArticle = round((($fret * $percentage) / 100),0);

       // Calcul du prix de revient de l'article
       $prixrevient = $paArticle + $fretArticle;

       return $prixrevient;
     }
}
