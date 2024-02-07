<?php

declare(strict_types=1);

namespace App\Application\UseCase\User\CreateUser\Dto;

use App\Domain\Validation\Traits\AssertEmailTrait;
use App\Domain\Validation\Traits\AssertLengthRangeTrait;
use App\Domain\Validation\Traits\AssertNotNullTrait;

class CreateUserInputDto
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;
    use AssertEmailTrait;

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
        $this->assertValueRangeLength($this->name, 3, 80);
        $this->assertEmail($this->email);
    }

    public static function create(?string $name, ?string $email, ?string $password): self
    {
        return new static($name, $email, $password);
    }
}
