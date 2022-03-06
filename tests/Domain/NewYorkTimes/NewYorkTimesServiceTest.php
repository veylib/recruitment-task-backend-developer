<?php

declare(strict_types=1);

namespace App\Tests\Domain\NewYorkTimes;

use App\Domain\NewYorkTimes\Client\ClientInterface;
use App\Domain\NewYorkTimes\Model\ArticleCollection;
use App\Domain\NewYorkTimes\NewYorkTimesService;
use PHPUnit\Framework\TestCase;

class NewYorkTimesServiceTest extends TestCase
{
    public function testGetArticles(): void
    {
        $mock = $this->createMock(ClientInterface::class);
        $mock->method('getArticles')->willReturn(new ArticleCollection());
        $service = new NewYorkTimesService($mock);
        $this->assertEquals(new ArticleCollection(), $service->getArticles());
    }
}
