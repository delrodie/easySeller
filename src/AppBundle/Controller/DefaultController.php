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
      // Sauvegarde du log de consultation
      $user = $this->getUser();
      $notification = $this->get('monolog.logger.notification');
      $notification->notice($user.' a consulté le tableau de bord .\n');

      // Affectation de l'user en fonction de son statut
      $roles[] = $user->getRoles();
      if ($roles[0][0] === 'ROLE_CAISSE') {
        # code...
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
