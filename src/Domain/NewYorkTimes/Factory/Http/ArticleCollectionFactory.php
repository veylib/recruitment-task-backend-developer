<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Factory\Http;

use App\Domain\NewYorkTimes\Mapper\Http\ArticleMapper;
use App\Domain\NewYorkTimes\Model\ArticleCollection;

class ArticleCollectionFactory
{
    public function __construct(
        private ArticleMapper $articleMapper
    ) {
    }

    public function create(array $docs): ArticleCollection
    {
        return new ArticleCollection(...array_map(fn($doc) => $this->articleMapper->map($doc), $docs));
    }
}
