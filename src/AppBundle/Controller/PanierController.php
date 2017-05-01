<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Controller de la facturation
 *
 * @Route("panier")
 */
class PanierController extends Controller
{

  /**
   * Les inforamtion du client concerné par la vente
   *
   * @Route("/client", name="client_concerne_par_la_vente")
   */
   public function clientAction(Request $request)
   {
       $session = $request->getSession();
       $em = $this->getDoctrine()->getManager();

       // Récuperation des informations relatives au clients
       if (!$session->has('clt')) {
         $nom = "Aucune vente encours";
         $code = "";
       } else {
         $client = $em->getRepository('AppBundle:Client')->findOneById($session->get('clt'));
         $nom = $client->getNom();
         $code = $client->getCode();
       }

       // Calcul du nombre de produit en panier
       if (!$session->has('panier')) {
         $article = 0;
       } else {
         $article = count($session->get('panier'));
       }

       return $this->render('panier/client.html.twig', array(
           'nom'  => $nom,
           'code'  => $code,
           'article' => $article,
           'client' => $client,
       ));
   }

  /**
   * Ajout de produit dans le panier vide
   *
   * @Route("/{client}/sans_produits", name="panier_sans_produit")
   */
   public function paniersansproduitAction(Request $request, $client)
   {
     $session = $request->getSession();
     $em = $this->getDoctrine()->getManager();

     // Mise en session de du client conerné par la vente
     if (!$session->has('clt')) $session->set('clt', $client);
     $clt = $session->get('clt');

     $session->set('clt',$clt);

     // Informations du client
     $client = $em->getRepository('AppBundle:Client')->findOneById($clt);

     // Liste des produits dont le stock est plus d'un
     $produits = $em->getRepository('AppBundle:Produit')->findProduitStockSupUn();
     //dump($client); die();

     return $this->render('panier/sans_produit.html.twig', array(
         'produits'  => $produits,
         'client' => $client,
     ));
   }

   /**
    * Ajout de produits dans le panier contenant des produits
    *
    * @Route("/avec_produits-{id}", name="panier_avec_produit")
    */
    public function panieravecproduitAction(Request $request, $id)
    {

      $em = $this->getDoctrine()->getManager();
      $session = $request->getSession();

      // Mise en session du produit
      if (!$session->has('panier')) $session->set('panier', array());
      $panier = $session->get('panier');


      // Si les session existe alors modifier les valeurs
      // Sinon ajouter les nouvelles valeurs
      if (array_key_exists($id, $panier)) {
        if ($request->query->get('qte') != null) {
          $panier[$id] = $request->query->get('qte');
        }
      } else {
        if ($request->query->get('qte') != null)
        {
          $panier[$id] = $request->query->get('qte');
            //dump($panier[$id]); die();
        } else{
          return $this->redirectToRoute('panier_sans_produit', array('client' => $session->get('clt')));
        }
      }

      // Enregistrement de la qte dans la session
      $session->set('panier',$panier);

      // Informations du client
      $client = $em->getRepository('AppBundle:Client')->findOneById($session->get('clt'));

      // Liste des produits dont le stock est plus d'un
      $produits = $em->getRepository('AppBundle:Produit')->findProduitStockSupUn();

      // Liste des produits en panier
      $paniers = $em->getRepository('AppBundle:Produit')->findArray(array_keys($session->get('panier')));
      //dump($paniers); die();

      return $this->render('panier/avec_produit.html.twig', array(
          'produits'  => $produits,
          'client' => $client,
          'paniers' => $paniers,
          'panier'  => $session->get('panier'),
      ));
    }

    /**
     * Stockage des produits
     *
     * @Route("/{id}/supprimer-produit", name="supprimer_panier_produit")
     */
     public function paniersupprimerAction(Request $request, $id)
     {
       $session = $request->getSession();
       $em = $this->getDoctrine()->getManager();

       $panier = $session->get('panier');


       if (array_key_exists($id, $panier))
       {
           unset($panier[$id]);
           $session->set('panier',$panier);

       }

       // S'il y a des produits dans le panier alors renvoie au panier avec produit
       // sinon annuler toute la vente et renvoyer a la liste des clients
       if (count($session->get('panier')) != 0) {

         // le dernier produit dans le panier
         $produit = $em->getRepository('AppBundle:Produit')->findDernierProduitEnPanier(array_keys($session->get('panier')));

       } else {
         return $this->redirectToRoute('annuler_panier_encours');
       }

       return $this->redirectToRoute('panier_avec_produit', array('id' => $produit->getId()));

     }

    /**
     *  Annulation de la vente en cours par suppression des produits en panier
     *
     * @Route("/annulation-du-panier", name="annuler_panier_encours")
     */
     public function annulationpanierAction(Request $request)
     {
       $session = $request->getSession();
       $em = $this->getDoctrine()->getManager();

       $clt = $session->get('clt');
       $panier = $session->get('panier');

       // Informations du client
       $client = $em->getRepository('AppBundle:Client')->findOneById($session->get('clt'));

       // Destruction des sessions
       $session->remove('clt');
       $session->remove('panier');

       // Sauvegarde du log d'annulation de la vente encours
       $user = $this->getUser();
       $notification = $this->get('monolog.logger.notification');
       $notification->notice($user.' a annulé la vente du client '.$client->getCode().'-'.$client->getNom().' .\n');

       $this->addFlash('notice', "L'annulation de la facture du client ".$client->getCode().'-'.$client->getNom()." a été effectuée avec succès.!");

       return $this->redirect($this->generateUrl('client_index'));
     }
}
