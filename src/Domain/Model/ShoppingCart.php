<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\IShoppingCartRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IShoppingCartRepository::class)]
class ShoppingCart
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    private string $product;
    private int $price;
    private int $quantity;
    private string $image;
    private string $category;
}
