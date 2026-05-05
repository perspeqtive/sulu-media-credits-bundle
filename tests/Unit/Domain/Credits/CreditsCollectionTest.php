<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\Credits;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\Credits;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Credits\CreditsCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockUrlRepository;
use PHPUnit\Framework\TestCase;

final class CreditsCollectionTest extends TestCase
{
    private CreditsCollection $collection;

    protected function setUp(): void
    {
        $this->collection = new CreditsCollection();
    }

    public function testAddAddsCreditsToCollection(): void
    {
        $credits = new Credits(
            1,
            'Media 1',
            'Copyright 1',
            'Credit 1',
            new MediaReferenceCollection([], new MockUrlRepository()),
        );

        $this->collection->add($credits);

        self::assertCount(1, $this->collection);
        self::assertTrue($this->collection->hasCredits());

        foreach ($this->collection as $item) {
            self::assertSame($credits, $item);
        }
    }

    public function testHasCreditsReturnsFalseWhenEmpty(): void
    {
        self::assertFalse($this->collection->hasCredits());
        self::assertCount(0, $this->collection);
    }
}
