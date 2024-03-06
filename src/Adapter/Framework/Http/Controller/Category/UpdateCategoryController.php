<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\UpdateCategoryRequestDto;
use App\Application\UseCase\Category\UpdateCategory\Dto\UpdateCategoryInputDto;
use App\Application\UseCase\Category\UpdateCategory\UpdateCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateCategoryController extends AbstractController
{
    public function __construct(private readonly UpdateCategory $updateCategoryService) {}

    #[Route('/api/category/update/{id}', name: 'api_category_update', methods: ['PATCH'])]
    public function __invoke(UpdateCategoryRequestDto $request, string $id): Response
    {
        $inputDto = UpdateCategoryInputDto::create($id, $request->name, $request->keys);

        $responseDto = $this->updateCategoryService->handle($inputDto);

        return $this->json($responseDto->categoryData);
    }
}
