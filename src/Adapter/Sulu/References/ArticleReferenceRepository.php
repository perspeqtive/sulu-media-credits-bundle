<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;
use Sulu\Article\Domain\Model\Article;
use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;
use Sulu\Content\Domain\Model\DimensionContentInterface;

readonly class ArticleReferenceRepository extends AbstractReferenceRepository implements ReferenceByTypeRepositoryInterface
{
    protected function getResourceKey(): string
    {
        return ArticleInterface::RESOURCE_KEY;
    }
}
