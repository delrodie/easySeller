<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 * @Route("client")
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AppBundle:Client')->findAll();

        $client = new Client();
        $form = $this->createForm('AppBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $nom = $client->getNom();

            // Initiale du fournisseur
            $initial = substr($nom, 0, 1);

            // Position du fournisseur en cours
            //$num = $em->getRepository('AppBundle:Client')->getClientID();
            $num = $em->getRepository('AppBundle:Client')->getNumeroOrdre();

            $code = 'C'.$initial.''.$num;

            $client->setCode($code);

            $em->persist($client);
            $em->flush();

            // Sauvegarde du log d'enregistrement du client
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a enregistré le client '.$code.'-'.$nom);

            $this->addFlash('notice', "Le Client ".$client->getNom()." a été crée avec succès.!");

            return $this->redirectToRoute('panier_sans_produit', array('client' => $client->getId()));
        }

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté la liste des clients par le module enregistrement. .\n');

        // Destruction des sessions
        $session->remove('clt');
        $session->remove('panier');
        $session->remove('produitEnPanier');

        return $this->render('client/index.html.twig', array(
            'clients' => $clients,
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('AppBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_show', array('id' => $client->getId()));
        }

        return $this->render('client/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('client/show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{slug}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client)
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('AppBundle:Client')->findAll();

        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('AppBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // Sauvegarde du log de modification du client
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a modifié le client '.$client->getCode().'-'.$client->getNom().' .\n');

            $this->addFlash('notice', "Le Client ".$client->getNom()." a été modifié avec succès.!");

            return $this->redirectToRoute('client_index');
        }

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté la liste des clients par le module modification .\n');

        // Recherche si le client est concerné par une vente
        $valid = $em->getRepository('AppBundle:Facture')->findOneBy(array('client'  => $client->getId()));

        return $this->render('client/edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'clients' => $clients,
            'valid' => $valid,
        ));
    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();

            // Sauvegarde du log de suppression
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a supprimé le client '.$client->getCode().'-'.$client->getNom());

            $this->addFlash('notice', "Le Client ".$client->getNom()." a été supprimé avec succès.!");
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
