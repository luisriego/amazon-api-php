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

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $image;

    //    private string $product; // I think we need here a Product entity or id
    //    private string $category; // because product have a category yet, I think this is not necessary
}
