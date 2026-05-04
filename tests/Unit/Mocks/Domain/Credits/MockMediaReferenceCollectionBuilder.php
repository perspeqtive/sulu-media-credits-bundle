<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\MediaReferenceCollectionBuilderInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;

final class MockMediaReferenceCollectionBuilder implements MediaReferenceCollectionBuilderInterface
{
    public MediaReferenceCollection $collectionToReturn;

    public mixed $requestedMedia = null;

    public function build($media): MediaReferenceCollection
    {
        $this->requestedMedia = $media;
        return $this->collectionToReturn;
    }
}
