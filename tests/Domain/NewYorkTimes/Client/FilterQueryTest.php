<?php

declare(strict_types=1);

namespace App\Tests\Domain\NewYorkTimes\Client;

use App\Domain\NewYorkTimes\Client\FilterQuery;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class FilterQueryTest extends TestCase
{
    public function testCanNotCreateEmpty(): void
    {
        $this->expectException(RuntimeException::class);
        new FilterQuery();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testAsQuery(array $categories, string $expected): void
    {
        $filterQuery = new FilterQuery(...$categories);
        $this->assertEquals($expected, $filterQuery->asQuery());
    }

    public function dataProvider(): iterable
    {
        yield [['cars'], 'fq=new_desk:("Cars")'];
        yield [['Cars'], 'fq=new_desk:("Cars")'];
        yield [['"cars"'], 'fq=new_desk:("Cars")'];
        yield [['\'cars\''], 'fq=new_desk:("Cars")'];
        yield [['cars', 'Automobiles'], 'fq=new_desk:("Cars" "Automobiles")'];
    }
}
