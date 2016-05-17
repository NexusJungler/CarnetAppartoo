<?php

namespace AppBundle\Controller;

use AppBundle\Form\contactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\contact;

class contactController extends Controller {

    public function addAction(Request $request) {

        $user = $this
            ->getUser()
            ->getId()
        ;
        $contact = new contact();
        $form = $this
            ->get('form.factory')
            ->create(new contactType, $contact)
        ;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $contact->setFKuser($user);
                $em = $this
                    ->getDoctrine()
                    ->getEntityManager()
                ;
                $em->persist($contact);
                $em->flush();
                return $this->redirect($this->generateUrl('index'));
            }
        }

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Ajouter un contact'
        ));
    }
    public function updateAction(Request $request)
    {
        $em = $this
            ->getDoctrine()
            ->getEntityManager()
        ;
        $id = $request->get('id');
        $contact = $em
            ->getRepository('AppBundle:contact')
            ->find($id)
        ;
        $form = $this
            ->get('form.factory')
            ->create(new contactType, $contact)
        ;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($contact);
                $em->flush();
                return $this->redirect($this->generateUrl('index'));
            }
        }

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Modidier le contact'
        ));
    }
    public function infoAction(Request $request)
    {
        $em = $this
            ->getDoctrine()
            ->getEntityManager()
        ;
        $contact = $request->get('id');
        $info = $em
            ->getRepository('AppBundle:contact')
            ->find($contact)
        ;
        return $this->render('default/info.html.twig', array(
            'info' => $info,
        ));
    }
    public function suppAction()
    {
        $em = $this
            ->getDoctrine()
            ->getEntityManager()
        ;
        $repository = $em->getRepository('AppBundle:contact');
        $tokill = $repository->find($_POST['id']);
        $em->remove($tokill);
        $em->flush();
         return new Response('contact supprimé!');

    }
}
