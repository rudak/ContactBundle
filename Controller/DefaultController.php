<?php

namespace Rudak\ContactBundle\Controller;

use Rudak\ContactBundle\Entity\Contact;
use Rudak\ContactBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const ACTIVE_ITEM = 'contact';

    public function indexAction()
    {
        $entity = new Contact();
        $form   = $this->getCreateForm($entity);
        $this->get('MenuBundle.Handler')->setActiveItem(self::ACTIVE_ITEM);
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

            $this->expedierMail($entity, $request);

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

    /**
     * expédition du nombre de messages non lus
     */
    function expedierMail(Contact $contact, $request)
    {
        $to   = $this->container->getParameter('email_to');
        $from = $this->container->getParameter('email_from');

        $message = \Swift_Message::newInstance()
            ->setSubject('Nouveau contact sur rc-montbron.fr')
            ->setContentType('text/html')
            ->setFrom($from)
            ->setTo($to)
            ->setBody($this->renderView('RudakContactBundle:Mail:contact.html.twig', array(
                'contact' => $contact,
                'site'    => $request->getUriForPath('')
            )));
        return $this->get('mailer')->send($message);
    }
}