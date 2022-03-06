<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes;

use App\Domain\NewYorkTimes\Client\ClientInterface;
use App\Domain\NewYorkTimes\Client\FilterQuery;
use App\Domain\NewYorkTimes\Model\ArticleCollection;

class NewYorkTimesService
{
    public function __construct(
        private ClientInterface $client
    ) {
    }

    public function getArticles(): ArticleCollection
    {
        return $this->client->getArticles(new FilterQuery('Automobiles', 'cars'));
    }
}
