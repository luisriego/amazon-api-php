<?php

namespace Tests\Unit\Application\Usecase\Product\CreateProduct;

use App\Application\UseCase\Product\CreateProduct\CreateProduct;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductOutputDto;
use App\Domain\Model\Product;
use App\Domain\Model\User;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\SecurityBundle\Security;

final class CreateProductTest extends TestCase
{
    private const VALUES = [
        'sku' => 'Ken: 9780688046590',
        'name' => 'The Pillars of the Earth',
        'description' => 'A wonderfully history',
        'price' => '3900',
        'category' => '9f9422af-cb8a-47a1-8764-680b93d637f6',
        'user' => 'efc3eedf-ad24-4990-83b7-ac36e256752c',
    ];

    private readonly ProductRepositoryInterface|MockObject $productRepository;

    private User $user;

    private readonly CreateProduct $useCase;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $security = $this->createMock(Security::class);
        $this->useCase = new CreateProduct(
            $this->productRepository,
            $categoryRepository,
            $security
        );

        $this->user = $userRepository->findOneByEmailOrFail("luisriego@hotmail.com");
    }

    public function testCreateProduct(): void
    {
        $dto = CreateProductInputDto::create(
            self::VALUES['sku'],
            self::VALUES['name'],
            self::VALUES['description'],
            self::VALUES['price'],
            self::VALUES['category'],
            $this->user->getId(),
        );

        $this->productRepository
            ->expects($this->once())
            ->method('add')
            ->with(
                $this->callback(function (Product $product): bool {
                    return $product->getName() === self::VALUES['name'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateProductOutputDto::class, $responseDTO);
    }
}