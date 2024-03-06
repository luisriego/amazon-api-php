<?php

namespace App\Adapter\Framework\Http\Controller\Category;

use App\Adapter\Framework\Http\Dto\Category\ActivationCategorySwitchRequestDto;
use App\Application\UseCase\Category\ActivationCategorySwitch\ActivationCategorySwitch;
use App\Application\UseCase\Category\ActivationCategorySwitch\Dto\ActivationCategorySwitchInputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivationCategorySwitchController extends AbstractController
{
    public function __construct(
        private readonly ActivationCategorySwitch $activationCategorySwitchService,
    ) {
    }

    #[Route('/api/category/switch-activation', name: 'api_switch_activation_category', methods: ['PUT'])]
    public function __invoke(ActivationCategorySwitchRequestDto $request): Response
    {
        $inputDto = ActivationCategorySwitchInputDto::create($request->id);

        $responseDto = $this->activationCategorySwitchService->handle($inputDto);

        return $this->json($responseDto->CategoryData);
    }
}