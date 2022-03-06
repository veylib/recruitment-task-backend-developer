<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Client;

class FilterQuery
{
    private const SUPPORTED_CATEGORIES = [
        'Automobiles',
        'Cars'
    ];

    private array $categories;

    public function __construct(
        string ...$categories
    ) {
        $categories = $this->normalize($categories);

        if (empty ($categories)) {
            throw new \RuntimeException('Set categories to filter');
        }

        if (!array_diff($categories, self::SUPPORTED_CATEGORIES)) {
            // TODO: return unsupported category name
            throw new \RuntimeException('Unsupported category');
        }

        $this->categories = $categories;
    }

    public function asQuery(): string
    {
        return sprintf('fq=new_desk:(%s)', implode(' ', $this->categories));
    }

    private function normalize(array $items): array
    {
        return array_map(fn(string $item) => '"' . ucfirst(str_replace(['\'','"'], '', $item)) . '"', $items);
    }
}
