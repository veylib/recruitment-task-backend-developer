<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Client;

use App\Domain\NewYorkTimes\Model\ArticleCollection;

interface ClientInterface
{
    /**
     * @throws ClientException
     */
    public function getArticles(FilterQuery $filterQuery): ArticleCollection;
}
