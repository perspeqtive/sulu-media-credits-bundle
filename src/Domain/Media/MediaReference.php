<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Media;

class MediaReference
{
    public function __construct(public string $title, public string $url)
    {
    }
}
