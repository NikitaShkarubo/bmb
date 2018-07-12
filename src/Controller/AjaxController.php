<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Settings;
use App\Form\ContactType;
use App\Manager\MailerManager;
use App\Util\Util;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends Controller
{
    /**
     * @Route(path="/ajax-contact", name="ajax-contact")
     *
     * @param Request       $request
     * @param MailerManager $mailerManager
     *
     * @return JsonResponse
     */
    public function contactAjaxAction(Request $request, MailerManager $mailerManager): JsonResponse
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

                $successMessage = $em->getRepository(Settings::class)->findOneById(1)->getContactSuccessRedirect();

                $mailerManager->sendEmailAdmin($form->getData());

                return $this->json($successMessage);
            }

            return $this->json(Util::getFirstFormError($form), Response::HTTP_BAD_REQUEST);
        }

        return $this->json('');
    }
}
