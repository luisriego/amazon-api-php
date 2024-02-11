<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait CreatedByTrait
{
    #[ORM\Column(type: 'string', length: 50)]
    protected string $createdBy;

    //    public function __construct(
    //        private readonly TokenStorageInterface $tokenStorage,
    //    ) {}

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    #[ORM\PrePersist]
    public function whoCreated(): void
    {
        //        $this->createdBy = $this->tokenStorage->getToken()->getUser()->getUserIdentifier();
        $this->createdBy = 'Admin';
    }
}
