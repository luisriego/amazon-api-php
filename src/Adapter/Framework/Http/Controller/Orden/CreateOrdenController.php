<?php

namespace App\Adapter\Framework\Http\Controller\Orden;

use App\Adapter\Framework\Http\Dto\Orden\CreateOrdenRequestDto;
use App\Application\UseCase\Orden\CreateOrden\CreateOrden;
use App\Application\UseCase\Orden\CreateOrden\Dto\CreateOrdenInputDto;
use App\Domain\Model\Orden;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateOrdenController extends AbstractController
{
    public function __construct(private readonly CreateOrden $createOrden)
    {
    }

    #[Route('/api/create-order', 'api_orden_create', methods: ['POST'])]
    public function __invoke(CreateOrdenRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Orden::MIN_ROLE,
            null,
            sprintf('Only user with [%s] or greater can create this type of resource.', Orden::MIN_ROLE),
        );

        $responseDto = $this->createOrden->handle(
            CreateOrdenInputDto::create(
                $requestDto->owner,
                $requestDto->orderAddress,
            )
        );

        return $this->json(['ordenId' => $responseDto->id], Response::HTTP_CREATED);
    }

}