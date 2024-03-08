<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\EventSubscriber;

use App\Domain\Model\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

use function sprintf;

class UserEventSubscriber implements EventSubscriber
{
    public function __construct(private readonly LoggerInterface $logger) {}

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User) {
            $this->logger->info(sprintf('User has been updated! Changes: %s', 'no lo sé'));
        }
    }
}
