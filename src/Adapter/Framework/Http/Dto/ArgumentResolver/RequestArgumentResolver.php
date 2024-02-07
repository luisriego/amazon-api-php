<?php

namespace App\Adapter\Framework\Http\Dto\ArgumentResolver;

use App\Adapter\Framework\Http\Dto\RequestDto;
use App\Adapter\Framework\Http\RequestTransformer\RequestTransformer;
use Generator;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly RequestTransformer $requestTransformer
    ) {
    }

    /**
     * @throws ReflectionException
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if (null === $argument->getType()) {
            return false;
        }

        return (new \ReflectionClass($argument->getType()))->implementsInterface(RequestDto::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $this->requestTransformer->transform($request);

        $class = $argument->getType();

        yield new $class($request);
    }
}