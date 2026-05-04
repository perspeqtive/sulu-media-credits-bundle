<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Domain\Media;

readonly class MediaReferenceCollection
{

    public function __construct(
        private iterable $references,
        private UrlRepositoryInterface $urlRepository,
    ) {}

    public function getNext(): iterable {

        foreach($this->references as $reference) {
            yield new MediaReference(
                $reference['referenceTitle'],
                $this->urlRepository->find($reference['referenceResourceId'], $reference['referenceLocale'] ?? 'de')
            );
        }

    }



}
