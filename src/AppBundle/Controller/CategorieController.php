<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categorie controller.
 *
 * @Route("categorie")
 */
class CategorieController extends Controller
{
    /**
     * Lists all categorie entities.
     *
     * @Route("/", name="categorie_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm('AppBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $nom = $categorie->getNom();

            // Initiale de la categorie
            $initial = substr($nom, 0, 1);

            // Position de la categorie en cours
            $num = $em->getRepository('AppBundle:Categorie')->getCategorieID();

            $code = $initial.''.$num;

            $categorie->setCode($code);

            $em->persist($categorie);
            $em->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a enregistré la catégorie '.$code.'-'.$nom.' .\n');

            $this->addFlash('notice', "La catégorie ".$categorie->getNom()." a été créée avec succès.!");

            return $this->redirectToRoute('categorie_index');
        }

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Categorie')->findAll();

        // Sauvegarde du log de consultation
        $user = $this->getUser();
        $notification = $this->get('monolog.logger.notification');
        $notification->notice($user.' a consulté la liste des categories .\n');

        return $this->render('categorie/index.html.twig', array(
            'categories' => $categories,
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new categorie entity.
     *
     * @Route("/new", name="categorie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm('AppBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));
        }

        return $this->render('categorie/new.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorie entity.
     *
     * @Route("/{id}", name="categorie_show")
     * @Method("GET")
     */
    public function showAction(Categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);

        return $this->render('categorie/show.html.twig', array(
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     * @Route("/{slug}/edit", name="categorie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);
        $editForm = $this->createForm('AppBundle\Form\CategorieType', $categorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $nom = $categorie->getNom();
            $num = $categorie->getCode();

            // Initiale de la categorie
            $initial = substr($nom, 0, 1);
            $numero = substr($num, 1, 2);

            $code = $initial.''.$numero;

            $categorie->setCode($code);

            $this->getDoctrine()->getManager()->flush();

            // Sauvegarde du log de consultation
            $user = $this->getUser();
            $notification = $this->get('monolog.logger.notification');
            $notification->notice($user.' a modifié la categorie '.$code.'-'.$nom.' .\n');

            $this->addFlash('notice', "La catégorie ".$categorie->getNom()." a été modifiée avec succès.!");

            return $this->redirectToRoute('categorie_index');
        }

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Categorie')->findAll();

        return $this->render('categorie/edit.html.twig', array(
            'categorie' => $categorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'categories' => $categories,
        ));
    }

    /**
     * Deletes a categorie entity.
     *
     * @Route("/{id}", name="categorie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Categorie $categorie)
    {
        $form = $this->createDeleteForm($categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }

    /**
     * Creates a form to delete a categorie entity.
     *
     * @param Categorie $categorie The categorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorie $categorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorie_delete', array('id' => $categorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
