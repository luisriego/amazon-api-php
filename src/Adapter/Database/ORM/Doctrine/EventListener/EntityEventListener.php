<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\EventListener;

use App\Domain\Enums\ProductStatus;
use App\Domain\Model\Address;
use App\Domain\Model\Order;
use App\Domain\Model\Product;
use App\Domain\Model\Review;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Bundle\SecurityBundle\Security;

readonly class EntityEventListener
{
    public function __construct(private Security $security) {}

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        $entity->creator($this->security->getUser()->getUserIdentifier());

        $entity->whoUpdated($this->security->getUser()->getUserIdentifier());

        if ($entity instanceof Address) {
            $entity->setOwner($this->security->getUser());
        }

        if ($entity instanceof Order) {
            $entity->setOwner($this->security->getUser());
        }

        if ($entity instanceof Review) {
            $entity->setOwner($this->security->getUser());
        }

        if ($entity instanceof Product) {
            if ($entity->getStock() < 1) {
                $entity->setStatus(ProductStatus::Inactive);
            } else {
                $entity->setStatus(ProductStatus::Active);
            }
        }
    }
}
