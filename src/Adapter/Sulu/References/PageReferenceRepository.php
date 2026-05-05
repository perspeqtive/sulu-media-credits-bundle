<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;
use Sulu\Component\HttpKernel\SuluKernel;

class PageReferenceRepository implements ReferenceByTypeRepositoryInterface
{
    public function __construct(private ReferenceRepositoryInterface $referenceRepository)
    {
    }

    public function findReferences(string $mediaId): iterable
    {
        return $this->referenceRepository->findFlatBy(
            [
                'resourceKey' => MediaInterface::RESOURCE_KEY,
                'resourceId' => $mediaId,
                'referenceResourceKey' => BasePageDocument::RESOURCE_KEY,
                'referenceContext' => SuluKernel::CONTEXT_WEBSITE,
            ],
            fields: ['referenceTitle', 'referenceResourceId', 'referenceResourceKey', 'referenceLocale'],
            distinct: true,
        );
    }
}
