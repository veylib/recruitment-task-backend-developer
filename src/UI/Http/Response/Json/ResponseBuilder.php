<?php

declare(strict_types=1);

namespace App\UI\Http\Response\Json;

use App\UI\Http\Response\ResponseBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseBuilder implements ResponseBuilderInterface
{
    private const SERIALIZER_FORMAT = 'json';

    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function create(mixed $data): Response
    {
        return new Response($this->serialize($data), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    private function serialize(mixed $data): string
    {
        return $this->serializer->serialize($data, self::SERIALIZER_FORMAT);
    }
}
