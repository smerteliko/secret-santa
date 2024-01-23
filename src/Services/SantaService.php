<?php

namespace App\Services;

use App\Entity\Person;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class SantaService
{
    private MailService $mailService;
    private $persons;

    public function __construct($persons, MailService $mailService)
    {
        $this->mailService = $mailService;
        $this->persons = $persons;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function serve() {
        $givesToPerson = (new Person())->shufflePersons($this->persons);

        foreach($this->persons as $i => $person) {
            $givesTo = $givesToPerson[$i];
           $this->mailService->sendMail($person, $givesTo);

        }

    }

}