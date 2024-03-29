<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\CreateCategoryRequestDto;
use App\Application\UseCase\Category\CreateCategory\CreateCategory;
use App\Application\UseCase\Category\CreateCategory\Dto\CreateCategoryInputDto;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateCategoryController extends AbstractController
{
    public function __construct(private readonly CreateCategory $createCategoryService) {}

    #[Route('api/category/create', 'api_category_create', methods: ['POST'])]
    public function __invoke(CreateCategoryRequestDto $request): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Category', Category::MIN_ROLE);
        }

        $responseDto = $this->createCategoryService->handle(
            CreateCategoryInputDto::create(
                $request->name,
            ),
        );

        return $this->json(['category_id' => $responseDto->id], Response::HTTP_CREATED);
    }
}
