<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class Person {

    #[Assert\NotBlank]
    protected string $fullName;

    #[Assert\NotBlank]
    #[Assert\Type(Assert\Email::INVALID_FORMAT_ERROR, message: 'The email {{ value }} is not a valid email.')]
    protected string $email;


    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPersonsCollectionAsEntity($persons): array|int
    {

        if(count($persons) < 4) {
            return 0;
        }

        $rtrnArr = [];
        foreach ($persons as $person) {
            $personEnt = new Person();
            $personEnt->setFullName($person['fullName']);
            $personEnt->setEmail($person['email']);
            $rtrnArr[] =$personEnt;
        }
        return $rtrnArr;
    }

    public function shufflePersons(array $target): array {
        $a = $target;
        $b = $a;

        shuffle($b);

        while ($this->hasSamePerson($a, $b)) {
            shuffle($b);
        }

        return $b;
    }

    public function hasSamePerson(array $a, array $b): bool {
        foreach ($a as $i => $p) {
            if ($p === $b[$i]) {
                return true;
            }
        }

        return false;
    }




}