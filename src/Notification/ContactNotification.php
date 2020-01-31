<?php

namespace App\Notification;

use App\Entity\Contact;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

class ContactNotification extends AbstractController
{

    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(Swift_Mailer $mailer, Environment $environment)
    {

        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function notify(Contact $contact)
    {
        $message = (new Swift_Message('Agence: ' . $contact->getProperty()->getTitle()))
            ->setFrom('noreply@monagence.com')
            ->setTo('projet.tokepi@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderView('emails/contact.html.twig',
                [
                    'contact' => $contact
                ]
            ), 'text/html');
        $this->mailer->send($message);
        $this->addFlash('success', 'Mail envoyé !');
    }
}