<?php

namespace App\Services;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

class MailService {

    private MailerInterface $mailer;

    private array $configs;

    private TranslatorInterface $translator;

    public function __construct(MailerInterface $mailer, array $configs, TranslatorInterface $translator){
        $this->mailer = $mailer;
        $this->configs = $configs;
        $this->translator= $translator;
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function sendMail($person, $givesTo) {
        $email = (new Email())
            ->from($this->configs['email_to_send_from']) // set your email here to avoid being flagged as spam
            ->to($person->getEmail())
            ->subject($this->translator->trans('New years information!'))
            ->text(
                $this->translator->trans('Hohohooooo !!!').$person->getFullName().PHP_EOL.
                $this->translator->trans(' Your happy man !').$givesTo->getFullName().PHP_EOL.
                $this->translator->trans(' Give him a nice gift and spend all your money. ! '));
        $this->mailer->send($email);

    }


}