<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    #[Route('/api', name: 'api_index')]
    public function index(): Response
    {
        $data = [
            'status' => 'ok',
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/error', name: 'api_error')]
    public function error(): Response
    {
        $this->logger->error('Error occurred.');

        return new JsonResponse(['error' => 'An error occurred.'], 500);
    }

    #[Route('/api/unexpected-error', name: 'api_unexpected_error')]
    public function unexpectedError(): Response
    {
        throw new \InvalidArgumentException('This is an unexpected error.');
    }
}
