<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\ReferenceFinderRepositoryInterface;

final readonly class ReferenceFinderRepository implements ReferenceFinderRepositoryInterface
{

    /**
     * @param iterable<ReferenceByTypeRepositoryInterface> $referenceByTypeRepositories
     */
    public function __construct(private iterable $referenceByTypeRepositories)
    {
        foreach ($this->referenceByTypeRepositories as $referenceByTypeRepository) {
            if ($referenceByTypeRepository instanceof ReferenceByTypeRepositoryInterface === true) {
                continue;
            }
            throw new \Exception('All reference repositories must implement ReferenceByTypeRepositoryInterface');
        }
    }

    public function findReferences(string $mediaId): iterable
    {
        foreach($this->referenceByTypeRepositories as $referenceByTypeRepository) {
            yield from $referenceByTypeRepository->findReferences($mediaId);
        }
    }

}