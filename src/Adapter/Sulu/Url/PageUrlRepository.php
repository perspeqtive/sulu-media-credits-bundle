<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\Url;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;
use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Content\Domain\Model\DimensionContentInterface;
use Sulu\Route\Application\Routing\Generator\RouteGeneratorInterface;
use Sulu\Page\Domain\Repository\PageRepositoryInterface;
use Sulu\Page\Domain\Model\PageInterface;
use Sulu\Route\Domain\Model\Route;

readonly class PageUrlRepository extends AbstractUrlRepository implements UrlRepositoryByTypeInterface
{
    protected function getResourceKey(): string
    {
        return PageInterface::RESOURCE_KEY;
    }
}
