<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait UpdatedByTrait
{
    #[ORM\Column(type: 'string', length: 50)]
    protected string $updatedBy;

//        public function __construct(
//            private readonly TokenStorageInterface $tokenStorage
//        ) {
//        }

    public function getUpdatedOBy(): string
    {
        return $this->updatedBy;
    }

    #[ORM\PrePersist]
    public function whoUpdated(): void
    {
//        $this->updatedBy = $this->tokenStorage->getToken()->getUser()->getUserIdentifier();
        $this->updatedBy = "Admin";
    }
}
