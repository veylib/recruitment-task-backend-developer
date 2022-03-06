<?php

declare(strict_types=1);

namespace App\Tests\UI\Http\Controller;

use App\Domain\NewYorkTimes\Client\ClientInterface;
use App\Domain\NewYorkTimes\Model\Article;
use App\Domain\NewYorkTimes\Model\ArticleCollection;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewYorkTimesControllerTest extends WebTestCase
{

    public function testGetArticles(): void
    {
        $client = static::createClient();
        $collection = new ArticleCollection(new Article('t', $datetime = new DateTimeImmutable(), 'l', 'i', 'url'));
        $this->recordClient($collection);
        $client->request('GET', '/nytimes', [], [], ['CONTENT_TYPE' => 'application/json']);
        $this->assertResponseIsSuccessful();

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals([
            [
                'title' => 't',
                'publicationDate' => $datetime->format('d.m.Y H:i:s'),
                'lead' => 'l',
                'image' => 'i',
                'url' => 'url',
            ]
        ], $response);
    }

    private function recordClient(ArticleCollection $articleCollection): void
    {
        $mock = $this->createMock(ClientInterface::class);
        $mock->method('getArticles')->willReturn($articleCollection);
        self::getContainer()->set(ClientInterface::class, $mock);
    }
}
