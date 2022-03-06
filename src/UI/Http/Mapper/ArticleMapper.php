<?php

namespace App\UI\Http\Mapper;

use App\Domain\NewYorkTimes\Model\Article;
use App\Domain\NewYorkTimes\Model\ArticleCollection;
use App\UI\Http\DTO\Article as ArticleDTO;

class ArticleMapper
{
    public function mapCollection(ArticleCollection $articleCollection): array
    {
        return array_map(fn(Article $article) => new ArticleDTO(
            $article->getTitle(),
            $article->getPublicationDate(),
            $article->getLead(),
            $article->getImage(),
            $article->getUrl(),
        ), iterator_to_array($articleCollection));
    }
}
