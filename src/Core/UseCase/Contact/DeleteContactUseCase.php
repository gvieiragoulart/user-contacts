<?php

namespace Core\UseCase\Contact;

use Core\Domain\Repository\ContactRepositoryInterface;

class CreateContactUseCase
{
    protected ContactRepositoryInterface $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}