<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;
use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;
use Sulu\Component\HttpKernel\SuluKernel;
use Sulu\Content\Domain\Model\DimensionContentInterface;
use Sulu\Page\Domain\Model\PageInterface;

readonly class PageReferenceRepository extends AbstractReferenceRepository implements ReferenceByTypeRepositoryInterface
{
    protected function getResourceKey(): string
    {
        return PageInterface::RESOURCE_KEY;
    }
}

