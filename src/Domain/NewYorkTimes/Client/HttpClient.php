<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Client;

use App\Domain\NewYorkTimes\Factory\Http\ArticleCollectionFactory;
use App\Domain\NewYorkTimes\Model\ArticleCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClient implements ClientInterface
{
    private const ARTICLE_SEARCH_URL = '/svc/search/v2/articlesearch.json';

    public function __construct(
        private HttpClientInterface $nytimesClient,
        private string $apiKey,
        private ArticleCollectionFactory $articleCollectionFactory
    ) {
    }

    public function getArticles(FilterQuery $filterQuery): ArticleCollection
    {
        $response = $this->nytimesClient->request('GET', self::ARTICLE_SEARCH_URL, [
            'query' => [$filterQuery->asQuery(), 'api-key' => $this->apiKey,],

        ]);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ClientException($response->getContent());
        }

        $content = $response->getContent();

        return $this->articleCollectionFactory->create(json_decode($content, true)['response']['docs']);
    }
}
