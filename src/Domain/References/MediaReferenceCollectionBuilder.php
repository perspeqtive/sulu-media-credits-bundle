<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaReferenceCollectionBuilderInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\ReferenceFinderRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\UrlRepositoryInterface;

readonly class MediaReferenceCollectionBuilder implements MediaReferenceCollectionBuilderInterface
{
    public function __construct(
        private ReferenceFinderRepositoryInterface $referenceFinderRepository,
        private UrlRepositoryInterface $urlRepository,
    ) {
    }

    public function build($media): MediaReferenceCollection
    {
        $result = $this->findMediaReferences($media);

        return new MediaReferenceCollection(
            $result,
            $this->urlRepository,
        );
    }

    protected function findMediaReferences(Media $media): iterable
    {
        return $this->referenceFinderRepository->findReferences((string) $media->id);
    }
}
