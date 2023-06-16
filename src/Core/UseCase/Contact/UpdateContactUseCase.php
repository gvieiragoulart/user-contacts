<?php

namespace Core\UseCase\Contact;

use Core\Domain\Repository\ContactRepositoryInterface;
use Core\UseCase\DTO\Contact\Update\ContactUpdateInputDto;
use Core\UseCase\DTO\Contact\Update\ContactUpdateOutputDto;

class CreateContactUseCase
{
    protected ContactRepositoryInterface $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ContactUpdateInputDto $input): ContactUpdateOutputDto
    {
        $contact = $this->repository->findById($input->id);

        $contact->update(
            name: $input->name,
            secondName: $input->secondName,
            number: $input->number,
            email: $input->email
        );

        $contact = $this->repository->update($contact);

        return new ContactUpdateOutputDto(
            id: $contact->id(),
            userId: $contact->userId,
            name: $contact->name,
            secondName: $contact->secondName,
            number: $contact->number,
            email: $contact->email
        );
    }
}