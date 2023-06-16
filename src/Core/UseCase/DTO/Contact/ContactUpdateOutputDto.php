<?php

namespace Core\UseCase\DTO\Contact;

class ContactUpdateOutputDto
{
    public function __construct(
        public string $id,
        public string $userId,
        public string $name,
        public string $secondName,
        public string $number,
        public string $email
    ) {
    }
}