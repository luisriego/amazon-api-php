<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Security;

use App\Domain\Model\Address;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use function in_array;

class AddressVoter extends Voter
{
    public const GROUP_READ = 'GROUP_READ';
    public const GROUP_CREATE = 'GROUP_CREATE';
    public const GROUP_UPDATE = 'GROUP_UPDATE';
    public const GROUP_DELETE = 'GROUP_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, $this->supportedAttributes(), true)
            && $subject instanceof Address;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        if (self::GROUP_CREATE === $attribute) {
            return true;
        }

        if (in_array($attribute, [self::GROUP_READ, self::GROUP_UPDATE, self::GROUP_DELETE], true)) {
            return $subject->isOwnedBy($token->getUser());
        }

        return false;
    }

    private function supportedAttributes(): array
    {
        return [
            self::GROUP_READ,
            self::GROUP_CREATE,
            self::GROUP_UPDATE,
            self::GROUP_DELETE,
        ];
    }
}
