<?php

namespace Core\UseCase\Contact;

use Core\UseCase\DTO\Contact\ContactCreateInputDto;
use Core\UseCase\DTO\Contact\ContactCreateOutputDto;
use Core\Domain\Entity\Contact;
use Core\Domain\Repository\ContactRepositoryInterface;

class CreateContactUseCase
{
    protected ContactRepositoryInterface $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ContactCreateInputDto $input): ContactCreateOutputDto
    {
        $contact = new Contact(
            userId: $input->userId,
            name: $input->name,
            secondName: $input->secondName,
            number: $input->number,
            email: $input->email
        );
        $contact = $this->repository->create($contact);
        return new ContactCreateOutputDto(
            id: $contact->id(),
            userId: $contact->userId,
            name: $contact->name,
            secondName: $contact->secondName,
            number: $contact->number,
            email: $contact->email
        );
    }
}