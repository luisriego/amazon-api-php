<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\CreateUser\Dto;

use App\Domain\Model\User;
use App\Domain\Validation\Traits\AssertMinimumAgeTrait;
use App\Domain\Validation\Traits\AssertNotNullTrait;

class CreateUserInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'name',
        'email',
        'password',
    ];

    public string $name;
    public string $email;
    public string $password;

    private function __construct(string $name, string $email, string $password)
    {
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;

        $this->assertNotNull(self::ARGS, [$this->name, $this->email, $this->password]);
    }

    public static function create(?string $name, ?string $email, ?string $password): self
    {
        return new static($name, $email, $password);
    }
}
