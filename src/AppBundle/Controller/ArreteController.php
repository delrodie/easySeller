<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Arrete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Arrete controller.
 *
 * @Route("arrete")
 */
class ArreteController extends Controller
{
    /**
     * Lists all arrete entities.
     *
     * @Route("/", name="arrete_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arretes = $em->getRepository('AppBundle:Arrete')->findAll();

        return $this->render('arrete/index.html.twig', array(
            'arretes' => $arretes,
        ));
    }

    /**
     * Creates a new arrete entity.
     *
     * @Route("/new", name="arrete_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $arrete = new Arrete();
        $user = $this->getUser();
        $form = $this->createForm('AppBundle\Form\ArreteType', $arrete, array('user' => $user));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $arrete = $this->container->get('arrete_ciasse')->ouvertureCaisse($arrete); // Service

            $em->persist($arrete);
            $em->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('arrete/new.html.twig', array(
            'arrete' => $arrete,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a arrete entity.
     *
     * @Route("/{id}", name="arrete_show")
     * @Method("GET")
     */
    public function showAction(Arrete $arrete)
    {
        $deleteForm = $this->createDeleteForm($arrete);

        return $this->render('arrete/show.html.twig', array(
            'arrete' => $arrete,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing arrete entity.
     *
     * @Route("/{id}/edit", name="arrete_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Arrete $arrete)
    {
        $deleteForm = $this->createDeleteForm($arrete);
        $user = $this->getUser();
        $editForm = $this->createForm('AppBundle\Form\ArreteTypeEdit', $arrete, array('user' => $user));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $arrete = $this->container->get('arrete_ciasse')->clotureCaisse($arrete); // Service
            //dump($arrete);die();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arrete_show', array('id' => $arrete->getId()));
        }

        return $this->render('arrete/edit.html.twig', array(
            'arrete' => $arrete,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a arrete entity.
     *
     * @Route("/{id}", name="arrete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Arrete $arrete)
    {
        $form = $this->createDeleteForm($arrete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($arrete);
            $em->flush();
        }

        return $this->redirectToRoute('arrete_index');
    }

    /**
     * Creates a form to delete a arrete entity.
     *
     * @param Arrete $arrete The arrete entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Arrete $arrete)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arrete_delete', array('id' => $arrete->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
