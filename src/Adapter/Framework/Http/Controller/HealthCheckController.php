<?php

namespace App\Adapter\Framework\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/api/health-check', name: 'api_health_check', methods: ['GET'], priority: 2)]
    public function __invoke(): Response
    {
        return $this->json(['message' => 'App stand-up and working']);
    }
}