<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;

readonly class Credits
{
    public function __construct(
        public int $mediaId,
        public string $mediaName,
        public ?string $copyright,
        public ?string $credit,
        public ?MediaReferenceCollection $references
    )
    {
    }
}
