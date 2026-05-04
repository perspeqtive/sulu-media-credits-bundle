<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollectionBuilder;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits\MockMediaReferenceCollectionBuilder;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Credits\MockMediaRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockUrlRepository;
use PHPUnit\Framework\TestCase;

use function iterator_to_array;

final class CreditsCollectionBuilderTest extends TestCase
{
    private CreditsCollectionBuilder $builder;
    private MockMediaRepository $mediaRepository;
    private MockMediaReferenceCollectionBuilder $referenceCollectionBuilder;

    protected function setUp(): void
    {
        $this->mediaRepository = new MockMediaRepository();
        $this->referenceCollectionBuilder = new MockMediaReferenceCollectionBuilder();
        $this->builder = new CreditsCollectionBuilder(
            $this->mediaRepository,
            $this->referenceCollectionBuilder,
        );
    }

    public function testBuildReturnsCreditsCollectionWithValidMedia(): void
    {
        $mediaWithCredits = new Media(1, 'Title 1', 'Copyright 1', 'Credit 1');
        $mediaWithoutCredits = new Media(2, 'Title 2', null, null);

        $this->mediaRepository->mediaToReturn = [$mediaWithCredits, $mediaWithoutCredits];
        $this->referenceCollectionBuilder->collectionToReturn = new MediaReferenceCollection(
            [],
            new MockUrlRepository(),
        );

        $collection = $this->builder->build('de');

        self::assertCount(1, $collection);
        self::assertSame('de', $this->mediaRepository->requestedLocale);

        $credits = iterator_to_array($collection)[0];
        self::assertSame(1, $credits->mediaId);
        self::assertSame('Title 1', $credits->mediaName);
        self::assertSame('Copyright 1', $credits->copyright);
        self::assertSame('Credit 1', $credits->credit);
        self::assertSame($this->referenceCollectionBuilder->collectionToReturn, $credits->references);
    }
}
