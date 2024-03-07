<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\DeleteCategoryRequestDto;
use App\Application\UseCase\Category\DeleteCategory\DeleteCategory;
use App\Application\UseCase\Category\DeleteCategory\Dto\DeleteCategoryInputDto;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteCategoryController extends AbstractController
{
    public function __construct(private readonly DeleteCategory $deleteCategoryService) {}

    #[Route('api/category/delete/{id}', name: 'api_category_delete', methods: ['DELETE'])]
    public function __invoke(DeleteCategoryRequestDto $dto): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Category', Category::MIN_ROLE);
        }

        $this->deleteCategoryService->handle(DeleteCategoryInputDto::create($dto->id));

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
