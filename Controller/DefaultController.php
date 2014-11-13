<?php

namespace Rudak\ContactBundle\Controller;

use Rudak\ContactBundle\Entity\Contact;
use Rudak\ContactBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $entity = new Contact();
        $form   = $this->getCreateForm($entity);

        return $this->render('RudakContactBundle:Default:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function createAction(Request $request)
    {
        $entity = new Contact();
        $entity->setIp($request->getClientIp());
        $entity->setDate(new \Datetime('NOW'));

        $form = $this->getCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Message envoyé avec succès!'
            );

            return $this->redirect($this->generateUrl('rudak_contact'));
        }


        $this->get('session')->getFlashBag()->add(
            'warning',
            'Problème d\'envoi du message !'
        );

        return $this->render('RudakContactBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function getCreateForm(Contact $entity)
    {
        $form = $this->createForm(new ContactType(), $entity, array(
            'action' => $this->generateUrl('rudak_contact_creation'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Envoyer ce message',
            'attr'  => array(
                'class' => 'btn btn-success'
            )
        ));

        return $form;
    }
}