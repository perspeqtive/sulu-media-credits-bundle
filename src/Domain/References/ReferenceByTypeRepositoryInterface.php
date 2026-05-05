<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\References;

interface ReferenceByTypeRepositoryInterface
{
    public function findReferences(string $mediaId): iterable;
}