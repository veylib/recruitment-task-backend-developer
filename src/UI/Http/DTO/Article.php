<?php

declare(strict_types=1);

namespace App\UI\Http\DTO;

use DateTimeInterface;

class Article
{
    public function __construct(
        private string $title,
        private DateTimeInterface $publicationDate,
        private string $lead,
        private string $image,
        private string $url,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublicationDate(): DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function getLead(): string
    {
        return $this->lead;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
