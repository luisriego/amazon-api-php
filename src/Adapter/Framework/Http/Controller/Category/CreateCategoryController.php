<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\CreateCategoryRequestDto;
use App\Application\UseCase\Category\CreateCategory;
use App\Application\UseCase\Category\Dto\CreateCategoryInputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateCategoryController extends AbstractController
{
    public function __construct(private readonly CreateCategory $createCategoryService) {}

    #[Route('api/create-category', 'api_category_create', methods: ['POST'])]
    public function __invoke(CreateCategoryRequestDto $request): Response
    {
        $responseDto = $this->createCategoryService->handle(
            CreateCategoryInputDto::create(
                $request->name,
            ),
        );

        return $this->json(['category_id' => $responseDto->id], Response::HTTP_CREATED);
    }
}
