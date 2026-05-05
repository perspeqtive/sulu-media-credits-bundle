<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\References;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\Media;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\MediaReferenceCollection;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Media\ReferenceFinderRepositoryInterface;
use PERSPEQTIVE\MediaCreditsBundle\Domain\References\MediaReferenceCollectionBuilder;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockReferenceFinderRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Media\MockUrlRepository;
use PHPUnit\Framework\TestCase;

final class MediaReferenceCollectionBuilderTest extends TestCase
{
    private MediaReferenceCollectionBuilder $builder;
    private MockReferenceFinderRepository $referenceFinderRepository;
    private MockUrlRepository $urlRepository;

    protected function setUp(): void
    {
        $this->referenceFinderRepository = new MockReferenceFinderRepository();
        $this->urlRepository = new MockUrlRepository();
        $this->builder = new MediaReferenceCollectionBuilder(
            $this->referenceFinderRepository,
            $this->urlRepository,
        );
    }

    public function testBuildReturnsMediaReferenceCollection(): void
    {
        $this->referenceFinderRepository->referencesToReturn = [[
            'referenceTitle' => 'Ref 1',
            'referenceResourceId' => '15',
            'referenceResourceKey' => 'pages',
            'referenceLocale' => 'de',
        ]];

        $media = new Media(1, 'Title', 'Copyright', 'Credit');

        $result = $this->builder->build($media);
        $resultData = iterator_to_array($result->getNext());
        self::assertCount(1, $resultData);
        self::assertSame('15', $resultData[0]->resourceId,);
        self::assertSame('pages', $resultData[0]->resourceType,);
    }
}
