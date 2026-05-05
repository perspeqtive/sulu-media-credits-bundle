<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\ReferenceFinderRepositoryInterface;

class MockReferenceFinderRepository implements ReferenceFinderRepositoryInterface
{

    public function __construct(public array $referencesToReturn = []) {}
    public function findReferences(string $mediaId): iterable
    {
       foreach ($this->referencesToReturn as $reference) {
           yield $reference;
       }
    }
}