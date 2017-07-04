<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BonreceptionController extends Controller
{
    /**
     * @Route("/liste-des-fournisseurs-pour-bon-reception", name="bon_reception_fournisseur")
     */
    public function fournisseurAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      // Sauvegarde du log de consultation
      $user = $this->getUser();
      $notification = $this->get('monolog.logger.notification');
      $notification->notice($user.' a consulté la liste des fournisseurs de bon de reception .\n');

      $fournisseurs = $em->getRepository('AppBundle:Approvisionnement')->getFournisseurByApprovisionnement();
      //var_dump($fournisseurs); die();
      
      if (!$fournisseurs) {
            throw $this->createNotFoundException('Aucun fournisseur trouvé.');
        }

        return $this->render('reception/fournisseur.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }

    /**
     * @Route("/statistique-des-fournisseurs-{id}-pour-bon-reception", name="statistique_bon_reception_fournisseur")
     */
     public function statistiquesfseurAction($id)
     {
       $em = $this->getDoctrine()->getManager();

       $stats = $em->getRepository('AppBundle:Approvisionnement')->getStatistiquesFournisseur($id);
       //var_dump($stats); die();

       return $this->render('reception/reception_statistique.html.twig', array(
           'stats'  => $stats,
       ));
     }

     /**
      * @Route("/{id}/infos-des-fournisseurs-pour-bon-reception", name="info_bon_reception_fournisseur")
      */
      public function infosfseurAction($id)
      {
        $em = $this->getDoctrine()->getManager(); //die($id);

        $fseur = $em->getRepository('AppBundle:Fournisseur')->find($id);
        //var_dump($fseurs); die();

        if (!$fseur) {
            throw $this->createNotFoundException('Aucun fournisseur trouvé.');
        }

        return $this->render('reception/reception_info.html.twig', array(
            'fseur'  => $fseur,
        ));
      }

    /**
     * Listes des approvisionnements concernés par le fournisseurs
     *
     * @Route("/liste-des-bons-de-reception-du-{id}-fournisseur", name="liste_bon_reception_fournisseur")
     */
     public function listebonreceptionAction($id)
     {
         $em = $this->getDoctrine()->getManager();
         
         $fseur = $em->getRepository('AppBundle:Fournisseur')->find($id);
         if(!$fseur) throw $this->createNotFoundException('Aucun fournisseur trouvé.');

         $listes = $em->getRepository('AppBundle:Approvisionnement')->findBy(array('fournisseur' => $id));
         if(!$listes) throw $this->createNotFoundException('Aucune liste trouvée.');

         return $this->render('reception/liste_achat.html.twig', array(
             'approvisionnements'   => $listes,
             'fseur'    => $fseur,
         ));
     }

     /**
     * Listes des produits concernés par l'approvisionnement
     *
     * @Route("/liste-des-produits{id}-du-bon-de-reception", name="liste_produit_bon_reception")
     */
     public function listeproduitsAction($id)
     {
         $em = $this->getDoctrine()->getManager();

        $approvisionner = $em->getRepository('AppBundle:Approvisionner')->findOneBy(array('approvisionnement' => $id ));
        $approvisionnement = $em->getRepository('AppBundle:Approvisionnement')->findOneById($id);
        //var_dump($stock);die();

        return $this->render('reception/liste_produit.html.twig', array(
            'approvisionner'  => $approvisionner,
            'approvisionnement'  => $approvisionnement,
        ));
     }


}
