<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse extends JsonResponse
{
    public function __construct(array $data, int $status = Response::HTTP_OK)
    {
        parent::__construct($data, $status);
    }
}
