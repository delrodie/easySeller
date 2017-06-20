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
 * @Route("facture")
 */
class FactureController extends Controller
{
    /**
     * Enregistrement des produits en panier
     */
     public function savePanier($request)
     {
       $session = $request->getSession();
       $em = $this->getDoctrine()->getManager();
       $panier = $session->get('panier');
       $clt = $session->get('clt');
       $stock = array();
       $totalMontantVente = 0;

       $produits = $em->getRepository('AppBundle:Produit')->findArray(array_keys($panier));
       $client = $em->getRepository('AppBundle:Client')->findOneBy(array('id' => $clt));

       foreach ($produits as $produit) {
           // Calcul du montant de vente de chaque produit
           $montantVente = ($produit->getPv() * $panier[$produit->getId()]);
           $totalMontantVente += $montantVente;

           // Mise en tableau des produits
           $produitEnPanier['produit'][$produit->getId()] = array(
              'code'  => $produit->getCode(),
              'nom'   => $produit->getNom(),
              'model' => $produit->getModel(),
              'pv'    => $produit->getPv(),
              'qte'   => $panier[$produit->getId()],
              'mtot'  => $montantVente,
           );

           // Mise a jour de la quantité du produit
           $produitStock = $em->getRepository('AppBundle:Produit')->findOneBy(array('id' => $produit->getId()));

           // Nouvelle quantité de ce produit
           $nouvelleQte = $produitStock->getQte() - $panier[$produit->getId()] ;
           $produitStock->setQte($nouvelleQte);
           $em->persist($produitStock);
           $em->flush();

       }

       // Mise en tableau des informations du client
       $produitEnPanier['totalMontantVente'] = $totalMontantVente;

       return $produitEnPanier;

     }

    /**
     * Validation du panier concerné par la vente
     *
     * @Route("/validation-du-panier", name="validation_du_panier")
     * @Method({"GET", "POST"})
     */
     public function validationpanierAction(Request $request)
     {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('AppBundle:Client')->findOneBy(array('id' => $session->get('clt')));

        $facture = new Facture();
        $form = $this->createForm('AppBundle\Form\FactureSaveType', $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          // Generation du numero de la facture
          $date = date('ymd') ;
          $num = $em->getRepository('AppBundle:Facture')->getNumeroOrdre();
          $numero = 'F'.$date.'-'.$num;

          //$client->setCode($code);
          $facture->setClient($client->getId());
          $facture->setNumero($numero);
          $facture->setNap($facture->getNap());
          $facture->setRemise($facture->getRemise());
          $facture->setVerse($facture->getVerse());
          $facture->setPanier($this->savePanier($request));

          if (!$session->has('produitEnPanier')) {
              $em->persist($facture);
          }

          $em->flush();

          // Destruction des sessions
          $session->remove('clt');
          $session->remove('panier');
          $session->remove('produitEnPanier');

          return $this->redirectToRoute('impression_facture', array('id' => $facture->getId()));
        }

        // Liste des produits en panier
        $produits = $em->getRepository('AppBundle:Produit')->findArray(array_keys($session->get('panier')));

        $panier = $session->get('panier');

        return $this->render('panier/validation.html.twig', array(
            'client'  => $client,
            'panier' => $panier,
            'produits'  => $produits,
            'form' => $form->createView(),
        ));
     }

    /**
     * Impression de la facture
     *
     * @Route("/impression-{id}facture", name="impression_facture")
     * @Method({"GET", "POST"})
     */
     public function impressionfactureAction($id)
     {
       $em = $this->getDoctrine()->getManager();

       $facture = $em->getRepository('AppBundle:Facture')->findOneById($id);
       $client = $em->getRepository('AppBundle:Client')->findOneById($facture->getClient());
       //dump($facture); die();

      // Derminons le montant en lettre du net a payer
      $montantEnLettre = $em->getRepository('AppBundle:Facture')->nombre_en_lettre($id);

       return $this->render('panier/facture.html.twig', array(
           'client'  => $client,
           'facture' => $facture,
           'montant_en_lettre'  => $montantEnLettre,
       ));
     }

    /**
     * Nombre de facture du client conerné
     *
     * @Route("/{clientID}/nombre-facture-du-client", name="nombre_facture")
     */
     public function nombrefactureAction($clientID)
     {
       $em = $this->getDoctrine()->getEntityManager();

       $nombre_facture = $em->getRepository('AppBundle:Facture')->findNombreFactureDuClient($clientID);

       return $this->render('panier/nombre_facture.html.twig', array(
           'nombre_facture' => $nombre_facture,
       ));
     }

    /**
     * Liste des factures de ventes du jour
     *
     * @Route("/liste-vente-du-jour", name="facture_vente_jour")
     */
    public function venteJourAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ventes = $em->getRepository('AppBundle:Facture')->findListeFactureDuJour();

        return $this->render('facture/vente_jour.html.twig', array(
            'ventes' => $ventes,
        ));
    }
}
