<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Facture controller.
 *
 * @Route("statistique")
 */
class StatistiqueController extends Controller
{
    /**
     * Total des factures de l'année en cours
     *
     * @Route("/annee", name="statistiques_annee")
     */
    public function statistiqueAnneeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dateDebut = date('Y-01-1 00:00:00', time());
        $dateFin = date('Y-12-31 23:59:59', time());

        $montantVente = $em->getRepository('AppBundle:Facture')->getMontantVente($dateDebut, $dateFin);
        $article = number_format($montantVente, 0, '', '.');

        return $this->render('stockage/nombre_produit.html.twig', [ 'articles' => $article]);
    }

    /**
     * Total des factures du mois en cours
     *
     * @Route("/mois", name="statistiques_mois")
     */
    public function statistiqueMoisAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dateDebut = date('Y-m-1 00:00:00', time());
        $dateFin = date('Y-m-31 23:59:59', time());

        $montantVente = $em->getRepository('AppBundle:Facture')->getMontantVente($dateDebut, $dateFin);
        $article = number_format($montantVente, 0, '', '.');

        return $this->render('stockage/nombre_produit.html.twig', [ 'articles' => $article]);
    }

    /**
     * Total des factures du jour en cours
     *
     * @Route("/jour", name="statistiques_jour")
     */
    public function statistiqueJourAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dateDebut = date('Y-m-d 00:00:00', time());
        $dateFin = date('Y-m-d 23:59:59', time()); //dump($dateFin);die();

        $montantVente = $em->getRepository('AppBundle:Facture')->getMontantVente($dateDebut, $dateFin);
        $article = number_format($montantVente, 0, '', '.');

        return $this->render('stockage/nombre_produit.html.twig', [ 'articles' => $article]);
    }

    /**
     * Total des factures par jour
     *
     * @Route("/du-jour-{jj}", name="statistiques_journaliere")
     */
    public function statistiqueJournaliereAction($jj)
    {
        $em = $this->getDoctrine()->getManager();

        $dateDebut = date('Y-m-'.$jj.' 00:00:00', time());
        $dateFin = date('Y-m-'.$jj.' 23:59:59', time()); //dump($dateDebut);die();

        $montantVente = $em->getRepository('AppBundle:Facture')->getMontantVente($dateDebut, $dateFin);
        //$article = number_format($montantVente, 0, '', '.');

        return $this->render('stockage/nombre_produit.html.twig', [ 'articles' => $montantVente]);
    }

    /**
     * Total des factures par mois
     *
     * @Route("/du-mois-{mm}", name="statistiques_mensuelle")
     */
    public function statistiqueMensuelleAction($mm)
    {
        $em = $this->getDoctrine()->getManager();

        $dateDebut = date('Y-'.$mm.'-01 00:00:00', time());
        $dateFin = date('Y-'.$mm.'-31 23:59:59', time()); //dump($dateDebut);die();

        $montantVente = $em->getRepository('AppBundle:Facture')->getMontantVente($dateDebut, $dateFin);
        //$article = number_format($montantVente, 0, '', '.');

        return $this->render('stockage/nombre_produit.html.twig', [ 'articles' => $montantVente]);
    }

}
