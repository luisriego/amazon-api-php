<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait WhoTrait
{
    use CreatedByTrait;
    use UpdatedByTrait;
}
