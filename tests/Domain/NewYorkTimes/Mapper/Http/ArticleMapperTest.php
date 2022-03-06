<?php

namespace App\Tests\Domain\NewYorkTimes\Mapper\Http;

use App\Domain\NewYorkTimes\Mapper\Http\ArticleMapper;
use App\Domain\NewYorkTimes\Model\Article;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ArticleMapperTest extends TestCase
{
    public function testMap(): void
    {
        $json = <<<'JSON'
{
    "abstract": "The Manchester derby has changed, mostly because United can no longer keep pace and City no longer has anything to prove.",
    "web_url": "https://www.nytimes.com/2022/03/06/sports/soccer/manchester-united-city-derby.html",
    "snippet": "The Manchester derby has changed, mostly because United can no longer keep pace and City no longer has anything to prove.",
    "lead_paragraph": "MANCHESTER, England — There was no tension in the last few minutes. It had gone long before the fourth goal arrived, marking the point at which victory turned into a rout. So had what little anxiety, what scant fretfulness might still have lingered. Instead, in the final few minutes of a derby, Manchester City’s fans could let go and enjoy themselves.",
    "source": "The New York Times",
    "multimedia": [
        {
            "rank": 0,
            "subtype": "xlarge",
            "caption": null,
            "credit": null,
            "type": "image",
            "url": "images/2022/03/07/multimedia/06onsoccer-manchester1-print1/06onsoccer1-articleLarge.jpg",
            "height": 356,
            "width": 600,
            "legacy": {
                "xlarge": "images/2022/03/07/multimedia/06onsoccer-manchester1-print1/06onsoccer1-articleLarge.jpg",
                "xlargewidth": 600,
                "xlargeheight": 356
            },
            "subType": "xlarge",
            "crop_name": "articleLarge"
        },
        {
            "rank": 0,
            "subtype": "superJumbo",
            "caption": null,
            "credit": null,
            "type": "image",
            "url": "images/2022/03/07/multimedia/06onsoccer-manchester1-print1/06onsoccer1-superJumbo.jpg",
            "height": 1215,
            "width": 2048,
            "legacy": {},
            "subType": "superJumbo",
            "crop_name": "superJumbo"
        },
        {
            "rank": 0,
            "subtype": "mobileMasterAt3x",
            "caption": null,
            "credit": null,
            "type": "image",
            "url": "images/2022/03/07/multimedia/06onsoccer-manchester1-print1/06onsoccer1-mobileMasterAt3x.jpg",
            "height": 1068,
            "width": 1800,
            "legacy": {},
            "subType": "mobileMasterAt3x",
            "crop_name": "mobileMasterAt3x"
        }
    ],
    "headline": {
        "main": "In Derby Without Drama, City Wins a Laugher",
        "kicker": "On Soccer",
        "content_kicker": null,
        "print_headline": null,
        "name": null,
        "seo": null,
        "sub": null
    },
    "keywords": [
        {
            "name": "subject",
            "value": "Soccer",
            "rank": 1,
            "major": "N"
        },
        {
            "name": "organizations",
            "value": "Manchester United (Soccer Team)",
            "rank": 2,
            "major": "N"
        },
        {
            "name": "organizations",
            "value": "Manchester City (Soccer Team)",
            "rank": 3,
            "major": "N"
        },
        {
            "name": "organizations",
            "value": "English Premier League",
            "rank": 4,
            "major": "N"
        },
        {
            "name": "persons",
            "value": "Guardiola, Josep",
            "rank": 5,
            "major": "N"
        },
        {
            "name": "subject",
            "value": "UEFA Champions League (Soccer)",
            "rank": 6,
            "major": "N"
        }
    ],
    "pub_date": "2022-03-06T20:37:16+0000",
    "document_type": "article",
    "news_desk": "Sports",
    "section_name": "Sports",
    "subsection_name": "Soccer",
    "byline": {
        "original": "By Rory Smith",
        "person": [
            {
                "firstname": "Rory",
                "middlename": null,
                "lastname": "Smith",
                "qualifier": null,
                "title": null,
                "role": "reported",
                "organization": "",
                "rank": 1
            }
        ],
        "organization": null
    },
    "type_of_material": "News",
    "_id": "nyt://article/f6b8c202-7e6e-5bb8-8030-0ef60f4d8307",
    "word_count": 1044,
    "uri": "nyt://article/f6b8c202-7e6e-5bb8-8030-0ef60f4d8307"
}
JSON;
        $mapper = new ArticleMapper();
        $article = $mapper->map(json_decode($json, true));

        $this->assertEquals(
            new Article(
                'In Derby Without Drama, City Wins a Laugher',
                (new DateTimeImmutable)->setTimestamp(1646599036),
                'MANCHESTER, England — There was no tension in the last few minutes. It had gone long before the fourth goal arrived, marking the point at which victory turned into a rout. So had what little anxiety, what scant fretfulness might still have lingered. Instead, in the final few minutes of a derby, Manchester City’s fans could let go and enjoy themselves.',
                'images/2022/03/07/multimedia/06onsoccer-manchester1-print1/06onsoccer1-superJumbo.jpg',
                'https://www.nytimes.com/2022/03/06/sports/soccer/manchester-united-city-derby.html',
            ),
            $article
        );
    }
}
