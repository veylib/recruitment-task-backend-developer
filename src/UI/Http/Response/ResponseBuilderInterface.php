<?php

declare(strict_types=1);

namespace App\UI\Http\Response;

use Symfony\Component\HttpFoundation\Response;

interface ResponseBuilderInterface
{
    public function create(mixed $data): Response;
}
