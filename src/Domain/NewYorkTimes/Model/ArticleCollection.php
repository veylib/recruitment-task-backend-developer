<?php

declare(strict_types=1);

namespace App\Domain\NewYorkTimes\Model;

use ArrayIterator;

class ArticleCollection extends ArrayIterator
{
    public function __construct(Article ...$articles)
    {
        parent::__construct($articles);
    }
}
