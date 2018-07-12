<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Manager\MailerManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends Controller
{
    /**
     * @Route(path="/contact", name="contact")
     *
     * @param Request       $request
     * @param MailerManager $mailerManager
     * @param string        $type
     *
     * @return Response
     */
    public function contactAction(Request $request, MailerManager $mailerManager, string $type = 'aside'): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('post')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $contact->setCreated(new \DateTime());
                $em->persist($contact);
                $em->flush();

                $mailerManager->sendEmailAdmin($form->getData());
            }
        }

        if ($type == 'main') {
            $template = '@App/default/contact.html.twig';
        } elseif ($type == 'aside') {
            $template = '@App/default/contact_aside.html.twig';
        }

        return $this->render($template, [
            'form' => $form->createView()
        ]);
    }
}
