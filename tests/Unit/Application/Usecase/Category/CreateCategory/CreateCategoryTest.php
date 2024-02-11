<?php

namespace Tests\Unit\Application\Usecase\Category\CreateCategory;

use App\Application\UseCase\Category\CreateCategory;
use App\Application\UseCase\Category\Dto\CreateCategoryInputDto;
use App\Application\UseCase\Category\Dto\CreateCategoryOutputDto;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Security\PasswordHasherInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateCategoryTest extends TestCase
{
    private const VALUES = [
        'name' => 'Books',
    ];

    private readonly CategoryRepositoryInterface|MockObject $categoryRepository;
    private readonly PasswordHasherInterface $passwordHasher;
    private readonly CreateCategory $useCase;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $this->passwordHasher = $this->createMock(PasswordHasherInterface::class);
        $this->useCase = new CreateCategory($this->categoryRepository, $this->passwordHasher);
    }

    public function testCreateCategory(): void
    {
        $dto = CreateCategoryInputDto::create(
            self::VALUES['name'],
        );

        $name = self::VALUES['name'];

        $this->categoryRepository
            ->expects($this->once())
            ->method('add')
            ->with(
                $this->callback(function (Category $category): bool {
                    return $category->getName() === self::VALUES['name'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateCategoryOutputDto::class, $responseDTO);
    }
}