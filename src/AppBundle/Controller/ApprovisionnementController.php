<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Approvisionnement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Approvisionnement controller.
 *
 * @Route("approvisionnement")
 */
class ApprovisionnementController extends Controller
{
    /**
     * Lists all approvisionnement entities.
     *
     * @Route("/", name="approvisionnement_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $approvisionnement = new Approvisionnement();
        $form = $this->createForm('AppBundle\Form\ApprovisionnementType', $approvisionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Date de facturation
            $date = $approvisionnement->getDatefac();

            // Decomposition de la date
            $an = substr($date, 8, 2);
            $mois = substr($date, 3, 2);
            $jj = substr($date, 0, 2);

            // Position de l'approvisionnement en cours
            $num = $em->getRepository('AppBundle:Approvisionnement')->getApprovisionnementID();

            $numero = 'AP'.$an.''.$mois.''.$jj.'-'.$num;

            $approvisionnement->setNumero($numero);

            $em->persist($approvisionnement);
            $em->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a enregistré l\'approvisionnement.');

            return $this->redirectToRoute('approvisionnement_show', array('slug' => $approvisionnement->getSlug()));
        }

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté la liste des approvisionnements .\n');

        $approvisionnements = $em->getRepository('AppBundle:Approvisionnement')->findAll();

        return $this->render('approvisionnement/index.html.twig', array(
            'approvisionnements' => $approvisionnements,
            'approvisionnement' => $approvisionnement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new approvisionnement entity.
     *
     * @Route("/new", name="approvisionnement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $approvisionnement = new Approvisionnement();
        $form = $this->createForm('AppBundle\Form\ApprovisionnementType', $approvisionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($approvisionnement);
            $em->flush();

            $this->addFlash('notice', "L'approvisionnement ".$approvisionnement->getNumero()." du fournisseur ".$approvisionnement->getFournisseur()." a été crée avec succès.!");

            return $this->redirectToRoute('approvisionnement_show', array('id' => $approvisionnement->getId()));
        }

        return $this->render('approvisionnement/new.html.twig', array(
            'approvisionnement' => $approvisionnement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a approvisionnement entity.
     *
     * @Route("/{slug}", name="approvisionnement_show")
     * @Method("GET")
     */
    public function showAction(Approvisionnement $approvisionnement, Request $request)
    {

        $deleteForm = $this->createDeleteForm($approvisionnement);
        $em = $this->getDoctrine()->getManager();
        $approvisionnements = $em->getRepository('AppBundle:Approvisionnement')->findAll();

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté l\'approvisionnements numéro '.$approvisionnement->getNumero().' du fournisseur '.$approvisionnement->getFournisseur());

        return $this->render('approvisionnement/show.html.twig', array(
            'approvisionnement' => $approvisionnement,
            'delete_form' => $deleteForm->createView(),
            'approvisionnements' => $approvisionnements,
        ));
    }

    /**
     * Displays a form to edit an existing approvisionnement entity.
     *
     * @Route("/{slug}/edit", name="approvisionnement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Approvisionnement $approvisionnement)
    {
        $deleteForm = $this->createDeleteForm($approvisionnement);
        $editForm = $this->createForm('AppBundle\Form\ApprovisionnementType', $approvisionnement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', "L'approvisionnement ".$approvisionnement->getNumero()." du fournisseur ".$approvisionnement->getFournisseur()." a été modifié avec succès.!");

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a modifié l\'approvisionnements numéro '.$approvisionnement->getNumero().' du fournisseur '.$approvisionnement->getFournisseur());


            return $this->redirectToRoute('approvisionnement_show', array('slug' => $approvisionnement->getSlug()));
        }

        $em = $this->getDoctrine()->getManager();

        $approvisionnements = $em->getRepository('AppBundle:Approvisionnement')->findAll();

        return $this->render('approvisionnement/edit.html.twig', array(
            'approvisionnement' => $approvisionnement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'approvisionnements' => $approvisionnements,
        ));
    }

    /**
     * Deletes a approvisionnement entity.
     *
     * @Route("/{id}", name="approvisionnement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Approvisionnement $approvisionnement)
    {
        $form = $this->createDeleteForm($approvisionnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($approvisionnement);
            $em->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a supprimé l\'approvisionnements numéro '.$approvisionnement->getNumero().' du fournisseur '.$approvisionnement->getFournisseur());

        }

        return $this->redirectToRoute('approvisionnement_index');
    }

    /**
     * Creates a form to delete a approvisionnement entity.
     *
     * @param Approvisionnement $approvisionnement The approvisionnement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Approvisionnement $approvisionnement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('approvisionnement_delete', array('id' => $approvisionnement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
