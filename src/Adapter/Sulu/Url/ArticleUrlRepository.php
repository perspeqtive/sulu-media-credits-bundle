<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;
use Sulu\Article\Domain\Model\Article;
use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Article\Domain\Repository\ArticleRepositoryInterface;
use Sulu\Content\Domain\Model\DimensionContentInterface;
use Sulu\Route\Application\Routing\Generator\RouteGeneratorInterface;
use Sulu\Route\Domain\Model\Route;
use Sulu\Route\Domain\Repository\RouteRepositoryInterface;

readonly class ArticleUrlRepository extends AbstractUrlRepository implements UrlRepositoryByTypeInterface
{

    protected function getResourceKey(): string
    {
        return ArticleInterface::RESOURCE_KEY;
    }

}
