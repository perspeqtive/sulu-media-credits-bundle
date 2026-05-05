<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceByTypeRepositoryInterface;

class MockReferenceByTypeRepository implements ReferenceByTypeRepositoryInterface
{
    public array $requestedMediaIds = [];

    public function __construct(public array $referencesToReturn = [])
    {
    }

    public function findReferences(string $mediaId): iterable
    {
        $this->requestedMediaIds[] = $mediaId;
        foreach ($this->referencesToReturn as $reference) {
            yield $reference;
        }
    }
}
