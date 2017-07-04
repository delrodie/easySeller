<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();

      // Sauvegarde du log de consultation
      $notification = $this->get('monolog.logger.notification');
      $notification->notice($user.' a consulté le tableau de bord .\n');

      // Affectation de l'user en fonction de son statut
      $roles[] = $user->getRoles();
      if ($roles[0][0] === 'ROLE_CAISSE') {
          $arrete = $em->getRepository('AppBundle:Arrete')->ouvertureCaisse($user->getId());//dump($arrete);die();

          foreach ($arrete as $key => $value) {
            $arreteStatut= $value->getStatut();
            $arreteID = $value->getId();
          }
          if ((!$arrete) || ($arreteStatut != 1)) {
            return $this->redirectToRoute('arrete_new');
          } else {
            return $this->redirectToRoute('arrete_edit', array('id' => $arreteID));
          }
      }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/log", name="log")
     */
     public function logAction()
     {
       return $this->render('default/log.html.twig');
     }

     /**
      * @Route("/fichier", name="logfichier")
      */
      public function logfichierAction()
      {
        return $this->render('default/notification.php');
      }


}
