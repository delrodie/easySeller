<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use AppBundle\Entity\Client;
use AppBundle\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Facture controller.
 *
 * @Route("caisse")
 */
class CaisseController extends Controller
{
    /**
     * Liste des factures du jour en cours
     *
     * @Route("/arreter-de-caisse", name="")
     */

}
