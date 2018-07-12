<?php

namespace App\Manager;

use App\Entity\Contact;
use App\Entity\Settings;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class MailerManager
{
    /** @var EntityManager */
    private $em;

    /** @var \Swift_Mailer */
    private $mailer;

    /** @var \Twig_Environment */
    private $twig;

    /**
     * MailerManager constructor.
     *
     * @param EntityManagerInterface $em
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(EntityManagerInterface $em, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param Contact $contact
     */
    public function sendEmailAdmin(Contact $contact): void
    {
        /** @var Settings $settings */
        $settings = $this->em->getRepository(Settings::class)->find(1);

        $from    = $settings->getContactEmailSendFrom();
        $to      = $settings->getContactEmailSendTo();
        $subject = $settings->getContactEmailSubject();

        try {
            $body = $this->twig->render('@App\email\contact.text.twig', ['contact' => $contact, 'subject' => $subject]);
        } catch (\Twig_Error $e) {
            $body = 'Error occurred. Contact developers.';
        }

        $emails = explode(',', str_replace(' ', '', $to));

        foreach ($emails as $email) {
            $message = (new \Swift_Message($subject))
                ->setFrom($from)
                ->setTo($email)
                ->setBody($body);

            if ($contact->getEmail()) {
                $message->setReplyTo($contact->getEmail());
            }

            $this->mailer->send($message);
        }
    }
}
