<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction(){

        $user = $this->getUser();
        $em = $this
            ->getDoctrine()
            ->getManager()
        ;
        $contacts = $em
            ->getRepository('AppBundle:contact')
            ->findBy(['fk_user' => $user])
        ;
        return $this->render('default/show.html.twig', [
            'contacts' => $contacts,
            'user' => $user,
        ]);
    }

}
