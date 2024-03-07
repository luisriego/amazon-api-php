<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\UpdateCategoryRequestDto;
use App\Application\UseCase\Category\UpdateCategory\Dto\DeleteCategoryInputDto;
use App\Application\UseCase\Category\UpdateCategory\UpdateCategory;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateCategoryController extends AbstractController
{
    public function __construct(private readonly UpdateCategory $updateCategoryService) {}

    #[Route('/api/category/update/{id}', name: 'api_category_update', methods: ['PATCH'])]
    public function __invoke(UpdateCategoryRequestDto $request, string $id): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Category', Category::MIN_ROLE);
        }

        $inputDto = DeleteCategoryInputDto::create($id, $request->name, $request->keys);

        $responseDto = $this->updateCategoryService->handle($inputDto);

        return $this->json($responseDto->categoryData);
    }
}
