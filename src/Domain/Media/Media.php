<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Media;

readonly class Media
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $copyright,
        public ?string $credit,
    ) {
    }
}
