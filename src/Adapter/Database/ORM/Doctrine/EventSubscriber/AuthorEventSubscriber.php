<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;

readonly class AuthorEventSubscriber implements EventSubscriber
{
        public function __construct(private Security $security)
        {
        }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $authenticatedUser = $this->security->getUser();

        $entity = $args->getObject();


        //        if ($entity instanceof User) {
        //            $this->logger->info(\sprintf('User has been updated! Changes: %s', 'no lo sé'));
        //        }
    }
}
