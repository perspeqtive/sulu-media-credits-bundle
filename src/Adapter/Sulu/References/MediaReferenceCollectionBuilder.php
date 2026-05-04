<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaReferenceCollectionBuilderInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\UrlRepositoryInterface;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;
use Sulu\Bundle\PageBundle\Document\BasePageDocument;
use Sulu\Bundle\ReferenceBundle\Domain\Repository\ReferenceRepositoryInterface;
use Sulu\Component\HttpKernel\SuluKernel;

readonly class MediaReferenceCollectionBuilder implements MediaReferenceCollectionBuilderInterface
{

    public function __construct(
        private ReferenceRepositoryInterface $referenceRepository,
        private UrlRepositoryInterface $urlRepository,
    ) {}

    public function build($media): MediaReferenceCollection {
        $result = $this->findMediaReferences($media);

        return new MediaReferenceCollection(
            $result,
            $this->urlRepository
        );
    }

    protected function findMediaReferences(Media $media): iterable
    {
        return $this->referenceRepository->findFlatBy([
            'resourceKey' => MediaInterface::RESOURCE_KEY,
            'resourceId' => (string) $media->id,
            'referenceResourceKey' => BasePageDocument::RESOURCE_KEY,
            'referenceContext' => SuluKernel::CONTEXT_WEBSITE,
        ],
            fields: ['referenceTitle', 'referenceResourceId', 'referenceLocale'],
            distinct: true
        );
    }

}