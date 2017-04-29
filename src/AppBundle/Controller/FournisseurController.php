<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fournisseur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fournisseur controller.
 *
 * @Route("fournisseur")
 */
class FournisseurController extends Controller
{
    /**
     * Lists all fournisseur entities.
     *
     * @Route("/", name="fournisseur_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fournisseur = new Fournisseur();
        $form = $this->createForm('AppBundle\Form\FournisseurType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $nom = $fournisseur->getNom();

            // Initiale du fournisseur
            $initial = substr($nom, 0, 1);

            // Position du fournisseur en cours
            $num = $em->getRepository('AppBundle:Fournisseur')->getFseurID();

            $code = 'F'.$initial.''.$num;

            $fournisseur->setCode($code);

            $em->persist($fournisseur);
            $em->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a enregistré le fournisseur '.$code.'-'.$nom.' .\n');

            $this->addFlash('notice', "Le fournisseur ".$fournisseur->getNom()." a été crée avec succès.!");

            return $this->redirectToRoute('fournisseur_index');
        }

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté la liste des fournisseurs .\n');

        $fournisseurs = $em->getRepository('AppBundle:Fournisseur')->findAll();

        return $this->render('fournisseur/index.html.twig', array(
            'fournisseurs' => $fournisseurs,
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new fournisseur entity.
     *
     * @Route("/new", name="fournisseur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm('AppBundle\Form\FournisseurType', $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();

            return $this->redirectToRoute('fournisseur_show', array('id' => $fournisseur->getId()));
        }

        return $this->render('fournisseur/new.html.twig', array(
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fournisseur entity.
     *
     * @Route("/{id}", name="fournisseur_show")
     * @Method("GET")
     */
    public function showAction(Fournisseur $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);

        return $this->render('fournisseur/show.html.twig', array(
            'fournisseur' => $fournisseur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fournisseur entity.
     *
     * @Route("/{slug}/edit", name="fournisseur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fournisseur $fournisseur)
    {
        $deleteForm = $this->createDeleteForm($fournisseur);
        $editForm = $this->createForm('AppBundle\Form\FournisseurType', $fournisseur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a modifié le fournisseur '.$fournisseur->getCode().'-'.$fournisseur->getNom().' .\n');

            $this->addFlash('notice', "Le fournisseur ".$fournisseur->getNom()." a été modifié avec succès.!");

            return $this->redirectToRoute('fournisseur_index');
        }

        $em = $this->getDoctrine()->getManager();

        $fournisseurs = $em->getRepository('AppBundle:Fournisseur')->findAll();

        return $this->render('fournisseur/edit.html.twig', array(
            'fournisseur' => $fournisseur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'fournisseurs' => $fournisseurs,
        ));
    }

    /**
     * Deletes a fournisseur entity.
     *
     * @Route("/{id}", name="fournisseur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fournisseur $fournisseur)
    {
        $form = $this->createDeleteForm($fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fournisseur);
            $em->flush();
        }

        return $this->redirectToRoute('fournisseur_index');
    }

    /**
     * Creates a form to delete a fournisseur entity.
     *
     * @param Fournisseur $fournisseur The fournisseur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fournisseur $fournisseur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fournisseur_delete', array('id' => $fournisseur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
