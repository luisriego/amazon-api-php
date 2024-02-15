<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use App\Domain\Model\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait CreatedByTrait
{
    #[ORM\Column(type: 'string', length: 50)]
    protected string $createdBy;

        public function __construct(
            private readonly Security $security,
        ) {}

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    public function whoCreated(): void
    {
//        $this->security->getUser()->getUserIdentifier();
    }

    public function creator(string $creator): void
    {
        $this->createdBy = $creator;
    }
}
