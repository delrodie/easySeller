<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class StockageController extends Controller
{
  
  /**
   * Le nombre de produits sur le bon d'approvisionnement
   *
   * @Route("/nombre-produits-bon-d_approvisionnement", name="nombre_produit_bon_approvisonnement")
   */
   public function nombreproduitstockageAction(Request $request)
   {
      $session = $request->getSession();

      // Si les sessions stockQte et stockPA n'existe pas alors affecter la valeur 0
      // Sinon compter le nombre d'articles dans les sessions
      if ((!$session->has('stockQte')) && (!$session->has('stockPA'))) {
        $articles = 0;
      } else {
        $articles = count($session->get('stockPA'));
      }

      return $this->render('stockage/nombre_produit.html.twig', array(
          'articles'  => $articles,
      ));

   }

   /**
    * Les informations relatives a l'approvisonnement en cours
    *
    * @Route("/fseur-bon-d_approvisionnement", name="fseur_bon_approvisonnement")
    */
    public function fseurstockageAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('fseur')) {
          $nom = "Aucun approvisionnement";
          $numero = "";
        } else {
          $fournisseur = $em->getRepository('AppBundle:Approvisionnement')->findOneById($session->get('fseur'));
          $nom = $fournisseur->getFournisseur();
          $numero = $fournisseur->getNumero();
        }

        if ($session->has('stockQte')){
            $produits = $em->getRepository('AppBundle:Produit')->findArray(array_keys($session->get('stockQte')));
            //var_dump($produits); die();
        } else {
            $produits = $em->getRepository('AppBundle:Produit')->findAll();
            //die('ici');
        }

        return $this->render('stockage/fseur.html.twig', array(
            'nom'  => $nom,
            'numero'  => $numero,
            'produits' => $produits,
            'stockQte' => $session->get('stockQte'),
        ));

    }

    /**
     * tableau des produits.
     *
     * @Route("/approvisionnement{id}", name="approvisionner_stock")
     * @Method({"GET", "POST"})
     */
     public function approvisionnerAction(Request $request, $id)
     {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        // Mise en session de l'ID du fournisseur
        if (!$session->has('fseur')) $session->set('fseur', $id);
        $fseur = $session->get('fseur');

        $session->set('fseur',$fseur);

        // Mise en session de la quantité
        if (!$session->has('stockQte')) $session->set('stockQte',array());
        $stockQte = $session->get('stockQte');

        // Mise en session du prix d'achat
        if (!$session->has('stockPA')) $session->set('stockPA',array());
        $stockPA = $session->get('stockPA');

        $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneById($id);

        $produits = $em->getRepository('AppBundle:Produit')->findAll();

        return $this->render('stockage/inventaire.html.twig', array(
            'stockQte'  => $session->get('stockQte'),
            'stockPA'  => $session->get('stockPA'),
            'approvisionnement' => $approvisionnement,
            'produits'  => $produits,
        ));
     }

    /**
     * tableau des produits.
     *
     * @Route("/{id}/approvisionner", name="approvisionner_stock_produit")
     */
     public function approvisionnerproduitAction(Request $request, $id)
     {

       $em = $this->getDoctrine()->getManager();
       $session = $request->getSession();

       // Mise en session de la quantité
       if (!$session->has('stockQte')) $session->set('stockQte',array());
       $stockQte = $session->get('stockQte');

       // Mise en session du prix d'achat
       if (!$session->has('stockPA')) $session->set('stockPA',array());
       $stockPA = $session->get('stockPA');

       // Si les session existe alors modifier les valeurs
       // Sinon ajouter les nouvelles valeurs
       if ((array_key_exists($id, $stockQte)) || (array_key_exists($id, $stockPA))) {
         if (($request->query->get('qte') != null) || ($request->query->get('pa') != null)) {
           $stockQte[$id] = $request->query->get('qte');
           $stockPA[$id] = $request->query->get('pa');
         }
       } else {
         if (($request->query->get('pa') != null) && ($request->query->get('qte') != null))
         {
           $stockQte[$id] = $request->query->get('qte');
           $stockPA[$id] = $request->query->get('pa');
         } else{
           return $this->redirect($this->generateUrl('approvisionnement'));
         }
       }

       $session->set('stockQte',$stockQte);
       $session->set('stockPA',$stockPA);
       //var_dump(); die();

       //return $this->redirect($this->generateUrl('stockage_produit'));
       $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneById($session->get('fseur'));

       $produits = $em->getRepository('AppBundle:Produit')->findAll();

       return $this->render('stockage/inventaire.html.twig', array(
           'stockQte'  => $session->get('stockQte'),
           'stockPA'  => $session->get('stockPA'),
           'approvisionnement' => $approvisionnement,
           'produits'  => $produits,
       ));

     }

     /**
      * Stockage des produits
      *
      * @Route("/{id}/supprimer-stockage", name="supprimer_stock_produit")
      */
      public function stockagesupprimerAction(Request $request, $id)
      {
        $session = $request->getSession();
        $stockQte = $session->get('stockQte');
        $stockPA = $session->get('stockPA');


        if ((array_key_exists($id, $stockQte)) || (array_key_exists($id, $stockQte)))
        {
            unset($stockQte[$id]);
            unset($stockPA[$id]);
            $session->set('stockQte',$stockQte);
            $session->set('stockPA',$stockPA);

        }

        return $this->redirect($this->generateUrl('stockage_produit'));

      }

     /**
      * Stockage des produits
      *
      * @Route("/stockage", name="stockage_produit")
      */
      public function stockageAction(Request $request)
      {
        $session = $request->getSession();
        //unset($session->get('stock'));
        //$session->set('stock');

        if (!$session->has('stockQte')) $session->set('stockQte', array());
        if (!$session->has('stockPA')) $session->set('stockPA', array());
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AppBundle:Produit')->findArray(array_keys($session->get('stockPA')));
        $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneBy(array('id' => $session->get('fseur')));
        //var_dump($session->get('fseur'));die();

        return $this->render('stockage/stockage.html.twig', array(
            'stockQte'  => $session->get('stockQte'),
            'stockPA'  => $session->get('stockPA'),
            'produits' => $produits,
            'approvisionnement'  => $approvisionnement,
        ));

      }

}
