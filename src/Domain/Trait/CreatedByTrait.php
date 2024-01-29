<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use Doctrine\ORM\Mapping as ORM;

trait CreatedByTrait
{
    #[ORM\Column(type: 'string', length: 50)]
    protected readonly string $createdBy;

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }
}
