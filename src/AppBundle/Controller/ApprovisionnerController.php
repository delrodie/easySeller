<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Approvisionner;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Approvisionnement;
use AppBundle\Entity\Fournisseur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Approvisionner controller.
 *
 * @Route("approvisionner")
 */
class ApprovisionnerController extends Controller
{
  /**
   * stockage des produits concernés par l'approvisionnement
   */
   public function stockage($request)
   {
      //$request = $this->getRequest();
      $em = $this->getDoctrine()->getManager();
      //$generator = $this->container->get('security.secure_random');
      $session = $request->getSession();
      $stockQte = $session->get('stockQte');
      $stockPA = $session->get('stockPA');
      $fseur = $session->get('fseur');
      $stock = array();
      $totalPrixRevient = 0;
      $totalBenefice = 0;

      $produits = $em->getRepository('AppBundle:Produit')->findArray(array_keys($stockPA));
      $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneBy(array('id' => $fseur));
      $fournisseur = $em->getRepository('AppBundle:Fournisseur')->find($approvisionnement->getFournisseur());

      //var_dump($fournisseur); die();
      // Montant, fret du bon d'approvisionnement
      $montantFac = $approvisionnement->getMontant();
      $fret = $approvisionnement->getFret();

      foreach ($produits as $produit) {

        // Calcul du prix de revient et du benefice par article
        $prixRevient = $em->getRepository('AppBundle:Approvisionner')->calculPrixRevient($montantFac,$fret,$produit->getPa());
        $benefice = (($produit->getPv() * $stockQte[$produit->getId()]) - $prixRevient);
        $prixRevientUnitaire = round(($prixRevient / $stockQte[$produit->getId()]),0);
        $beneficeUnitaire = round(($benefice / $stockQte[$produit->getId()]),0);
        $totalPrixRevient += $prixRevient;
        $totalBenefice += $benefice;

        $stockage['produit'][$produit->getId()] = array(
                                                          'code'  => $produit->getCode(),
                                                          'categorie' => $produit->getCategorie(),
                                                          'nom' => $produit->getNom(),
                                                          'model' => $produit->getModel(),
                                                          'pv'  => $produit->getPv(),
                                                          'qte' => $stockQte[$produit->getId()],
                                                          'pa'  => $stockPA[$produit->getId()],
                                                          'pru' => $prixRevientUnitaire,
                                                          'benu'  => $beneficeUnitaire,
                                                          'prtot' => $prixRevient,
                                                          'betot' => $benefice,
                                                        );
      }

      $tockage['approvisionnement'] = array(
                                              'fseurNom' => $fournisseur->getNom(),
                                              'fseurAdresse'  => $fournisseur->getAdresse(),
                                              'fseurContact'  => $fournisseur->getContact(),
                                              'facture' => $approvisionnement->getFacture(),
                                              'fret'  => $approvisionnement->getFret(),
                                              'montant' => $approvisionnement->getMontant(),
                                              'datefac' => $approvisionnement->getDatefac(),
                                            );

      $tockage['totalPrixRevient'] = $totalPrixRevient;
      $stockage['totalBenefice']  = $totalBenefice;
      //$stockage['token'] = bin2hex($generator->nextBytes(20));

      return $stockage;
   }

   /**
    * Validation de l'approvisionnement
    *
    * @Route("/validation", name="validation_approvionnement_produits")
    */
    public function validationAction(Request $request)
    {
      //var_dump($request); die();
      $session = $request->getSession();
      $em = $this->getDoctrine()->getManager();

      $fseur = $session->get('fseur');
      $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneBy(array('id' => $fseur));

      if (!$session->has('stockage'))
          $stockage = new Approvisionner();
      else
          $stockage = $em->getRepository('AppBundle:Approvisionner')->find($session->get('stockage'));

      $stockage->setApprovisionnement($approvisionnement->getId());
      $stockage->setReference(1);
      $stockage->setStock($this->stockage($request));

      if (!$session->has('stockage')) {
          $em->persist($stockage);
      }

      $em->flush();

      // Destruction des sessions
      $session->remove('fseur');
      $session->remove('stockQte');
      $session->remove('stockPA');
      $session->remove('stockage');

      return $this->redirect($this->generateUrl('homepage'));

    }
}
