<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\Media;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReference;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockUrlRepository;
use PHPUnit\Framework\TestCase;

use function iterator_to_array;

final class MediaReferenceCollectionTest extends TestCase
{
    private MediaReferenceCollection $collection;
    private MockUrlRepository $urlRepository;
    private array $references;

    protected function setUp(): void
    {
        $this->urlRepository = new MockUrlRepository();
        $this->references = [
            ['referenceTitle' => 'Ref 1', 'referenceResourceId' => '1', 'referenceResourceKey' => 'pages', 'referenceLocale' => 'de'],
            ['referenceTitle' => 'Ref 2', 'referenceResourceId' => '2', 'referenceResourceKey' => 'articles'],
        ];
        $this->collection = new MediaReferenceCollection($this->references, $this->urlRepository);
    }

    public function testGetNextYieldsMediaReferences(): void
    {
        $this->urlRepository->urlToReturn = 'https://example.com';

        $results = iterator_to_array($this->collection->getNext());

        self::assertCount(2, $results);
        self::assertInstanceOf(MediaReference::class, $results[0]);
        self::assertSame('Ref 1', $results[0]->title);
        self::assertSame('https://example.com', $results[0]->url);

        self::assertSame('Ref 2', $results[1]->title);
        self::assertSame('de', $this->urlRepository->requestedLocale);
    }
}
