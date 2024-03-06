<?php

namespace Tests\Unit\Application\Usecase\Category\CreateCategory;

use App\Application\UseCase\Category\CreateCategory\CreateCategory;
use App\Application\UseCase\Category\CreateCategory\Dto\CreateCategoryInputDto;
use App\Application\UseCase\Category\CreateCategory\Dto\CreateCategoryOutputDto;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateCategoryTest extends TestCase
{
    private const VALUES = [
        'name' => 'Books',
    ];

    private readonly CategoryRepositoryInterface|MockObject $categoryRepository;
    private readonly CreateCategory $useCase;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $this->useCase = new CreateCategory($this->categoryRepository);
    }

    public function testCreateCategory(): void
    {
        $dto = CreateCategoryInputDto::create(
            self::VALUES['name'],
        );

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