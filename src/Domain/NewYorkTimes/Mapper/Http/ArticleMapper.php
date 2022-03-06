<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Mapper\Http;

use App\Domain\NewYorkTimes\Model\Article;
use DateTimeImmutable;
use RuntimeException;

class ArticleMapper
{
    private const IMAGE_TYPE = 'superJumbo';

    public function map(array $data): Article
    {
        return new Article(
            $data['headline']['main'],
            new DateTimeImmutable($data['pub_date']),
            $data['lead_paragraph'],
            $this->mapImage($data),
            $data['web_url'],
        );
    }

    private function mapImage(array $data): string
    {
        foreach ($data['multimedia'] as $multimedium) {
            if ($multimedium['subType'] === self::IMAGE_TYPE) {
                return $multimedium['url'];
            }
        }

        throw new RuntimeException('Missed multimedia');
    }
}
