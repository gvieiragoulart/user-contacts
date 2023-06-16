<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethods;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Email;
use Core\Domain\ValueObject\Uuid;

class Contact
{
    use MagicMethods;

    public function __construct(
        protected Uuid|string $id = '',
        protected Uuid|string $userId = '',
        protected string $name = '',
        protected string $secondName = '',
        protected string $number = '',
        protected string $email = ''
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::generate();
        $this->userId = new Uuid($this->userId);

        $this->validate();
    }

    public function update(?string $name, ?string $secondName, ?string $number, ?string $email)
    {
        $this->name = $name ?? $this->name;
        $this->secondName = $secondName ?? $this->secondName;
        $this->number = $number ?? $this->number;
        $this->email = $email ?? $this->email;

        $this->validate();
    }

    private function validate()
    {
        DomainValidation::notNull($this->id, 'Id is required');
        DomainValidation::notNull($this->userId, 'userId is required');
        DomainValidation::notNull($this->name, 'Name is required');
        DomainValidation::strMaxLenght($this->name, 100, 'Name should not greater than 100 characters');
        DomainValidation::strMinLenght($this->name, 3, 'Name should not less than 3 characters');
        DomainValidation::notNull($this->number, 'Number is required');
        DomainValidation::notNull($this->email, 'Email is required');
        DomainValidation::strCanNullAndMaxLenght($this->secondName, 100, 'Second name should not greater than 100 characters');
    }
}