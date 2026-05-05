<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;
use Sulu\Bundle\ArticleBundle\Document\ArticleDocument;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;
use Sulu\Bundle\ReferenceBundle\Infrastructure\Doctrine\Repository\ReferenceRepository;
use Sulu\Component\HttpKernel\SuluKernel;

class ArticleReferenceRepository implements ReferenceByTypeRepositoryInterface
{
    public function __construct(private ReferenceRepository $referenceRepository)
    {

    }

    public function findReferences(string $mediaId): iterable
    {
        return $this->referenceRepository->findFlatBy(
            [
                'resourceKey' => MediaInterface::RESOURCE_KEY,
                'resourceId' => $mediaId,
                'referenceResourceKey' => ArticleDocument::RESOURCE_KEY,
                'referenceContext' => SuluKernel::CONTEXT_WEBSITE,
            ],
            fields: ['referenceTitle', 'referenceResourceId', 'referenceResourceKey', 'referenceLocale'],
            distinct: true,
        );
    }
}