<?php

namespace Core\UseCase\DTO\Contact\Update;

class ContactUpdateInputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $secondName,
        public string $number,
        public string $email
    ) {
    }
}