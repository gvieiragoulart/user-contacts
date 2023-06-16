<?php

namespace Tests\Unit\Domain\UseCase;

use Core\UseCase\DTO\Contact\Create\ContactCreateOutputDto;
use Core\UseCase\DTO\Contact\Create\ContactCreateInputDto;
use Core\Domain\Entity\Contact;
use Core\Domain\Repository\ContactRepositoryInterface;
use Core\UseCase\Contact\CreateContactUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateContactUseCaseTest extends TestCase
{
    private Mockery $mockRepo;
    private Mockery $mockEntity;
    private Mockery $mockInputDto;
    
    public function testCreateNewContact()
    {
        $id = (string)Uuid::uuid4()->toString();
        $userId = (string)Uuid::uuid4()->toString();
        $name = 'New Contact';
        $secondName = 'Second Name Contact';
        $number = '16123456789';
        $email = 'teste@teste.com';

        $this->mockEntity = Mockery::mock(stdClass::class, Contact::class, [
            $id,
            $userId,
            $name,
            $secondName,
            $number,
            $email
        ]);
        $this->mockEntity->shouldReceive('id')->andReturn(Uuid::uuid4()->toString());        
        $this->mockRepo = Mockery::mock(stdClass::class, ContactRepositoryInterface::class);
        $this->mockRepo->shouldReceive('create')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(ContactCreateInputDto::class, [
            $userId,
            $name,
            $secondName,
            $number,
            $email
        ]);

        $useCase = new CreateContactUseCase($this->mockRepo);
        $response = $useCase->execute($this->mockInputDto);
        
        $this->assertInstanceOf(ContactCreateOutputDto::class, $response);
        $this->assertEquals($response->id, $this->mockEntity->id());
        $this->assertEquals($response->userId, $this->mockEntity->userId);
        $this->assertEquals($response->name, $this->mockEntity->name);
        $this->assertEquals($response->secondName, $this->mockEntity->secondName);
        $this->assertEquals($response->number, $this->mockEntity->number);
        $this->assertEquals($response->email, $this->mockEntity->email);

        /**
         * Spies
         */

        // $this->spy = Mockery::spy(stdClass::class, ContactRepositoryInterface::class);
        // $this->spy->shouldReceive('create')->andReturn($this->mockEntity);

        // $useCase = new CreateContactUseCase($this->spy);
        // $response = $useCase->execute($this->mockInputDto);
        // $this->spy->shouldHaveReceived('create');

        Mockery::close();
    }
}