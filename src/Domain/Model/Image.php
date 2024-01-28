<?php

namespace App\Domain\Model;

use App\Domain\Common\BaseDomainModel;
use Doctrine\ORM\Mapping as ORM;

class Image extends BaseDomainModel
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $url;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'images')]
    private Product $product;

    #[ORM\Column(type: 'string', length: 255)]
    private string $publicCode;
}