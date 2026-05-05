<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Media;

interface ReferenceFinderRepositoryInterface
{
    public function findReferences(string $mediaId): iterable;
}
