<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollectionBuilder;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockUrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockReferenceRepository;
use PHPUnit\Framework\TestCase;

final class MediaReferenceCollectionBuilderTest extends TestCase
{
    private MediaReferenceCollectionBuilder $builder;
    private MockReferenceRepository $referenceRepository;
    private MockUrlRepository $urlRepository;

    protected function setUp(): void
    {
        $this->referenceRepository = new MockReferenceRepository();
        $this->urlRepository = new MockUrlRepository();
        $this->builder = new MediaReferenceCollectionBuilder(
            $this->referenceRepository,
            $this->urlRepository,
        );
    }

    public function testBuildReturnsMediaReferenceCollection(): void
    {
        $media = new Media(1, 'Title', 'Copyright', 'Credit');

        $this->referenceRepository->flatResultsToReturn = [];

        $result = $this->builder->build($media);

        self::assertSame('1', (string) $this->referenceRepository->requestedFilters['resourceId']);
        self::assertSame('media', (string) $this->referenceRepository->requestedFilters['resourceKey']);
        self::assertSame('pages', (string) $this->referenceRepository->requestedFilters['referenceResourceKey']);
    }
}
