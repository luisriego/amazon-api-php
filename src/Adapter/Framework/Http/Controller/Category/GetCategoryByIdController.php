<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\GetCategoryByIdRequestDto;
use App\Application\UseCase\Category\GetCategoryById\Dto\GetCategoryByIdInputDto;
use App\Application\UseCase\Category\GetCategoryById\GetCategoryById;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetCategoryByIdController extends AbstractController
{
    public function __construct(private readonly GetCategoryById $categoryByIdService) {}

    #[Route('/api/category/get-category/{id}', name: 'api_get_category_by_id', methods: ['GET'])]
    public function __invoke(GetCategoryByIdRequestDto $dto): Response
    {
        $responseDto = $this->categoryByIdService->handle(GetCategoryByIdInputDto::create($dto->id));

        return $this->json(
            [
                'category_id' => $responseDto->id,
                'category_name' => $responseDto->name,
            ],
            Response::HTTP_OK,
        );
    }
}
