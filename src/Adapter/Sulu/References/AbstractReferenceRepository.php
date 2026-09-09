<?php

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;
use Sulu\Content\Domain\Model\DimensionContentInterface;

abstract readonly class AbstractReferenceRepository
{

    public function __construct(private ReferenceRepositoryInterface $referenceRepository)
    {
    }

    abstract protected function getResourceKey(): string;

    public function findReferences(string $mediaId): iterable
    {
        return $this->referenceRepository->findFlatBy(
            [
                'resourceKey' => MediaInterface::RESOURCE_KEY,
                'resourceId' => $mediaId,
                'referenceResourceKey' => $this->getResourceKey(),
                'referenceContext' => DimensionContentInterface::STAGE_LIVE,
            ],
            fields: ['referenceTitle', 'referenceResourceId', 'referenceResourceKey', 'referenceLocale'],
            distinct: true,
        );
    }

}