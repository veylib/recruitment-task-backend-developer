<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Domain\NewYorkTimes\NewYorkTimesService;
use App\UI\Http\Mapper\ArticleMapper;
use App\UI\Http\Response\ResponseBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewYorkTimesController extends AbstractController
{
    public function __construct(
        private NewYorkTimesService $newYorkTimesService,
        private ArticleMapper $articleMapper,
        private ResponseBuilderInterface $responseBuilder
    ) {
    }

    /**
     * @Route(path="/nytimes", methods={"GET"})
     */
    public function getArticles(): Response
    {
        $articles = $this->newYorkTimesService->getArticles();

        return $this->responseBuilder->create($this->articleMapper->mapCollection($articles));
    }
}
