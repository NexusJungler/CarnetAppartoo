<?php

namespace UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->container
            ->get('security.context')
            ->getToken()
            ->getUser()
        ;
        if ($user == 'anon.') {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        } else {
            return $this->forward('AppBundle:Default:index');
        }
    }
}
