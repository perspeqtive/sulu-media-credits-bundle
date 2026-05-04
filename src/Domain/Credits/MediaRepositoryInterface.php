<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

use Generator;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;

interface MediaRepositoryInterface
{
    /**
     * @return Generator<Media>
     */
    public function getAllMedia(string $locale = 'de'): Generator;
}
