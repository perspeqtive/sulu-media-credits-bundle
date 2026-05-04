<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;

interface MediaRepositoryInterface
{
    /**
     * @param string $locale
     * @return Media[]
     */
    public function getAllMedia(string $locale = 'de'): array;
}