<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References\PageReferenceRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockReferenceRepository;
use PHPUnit\Framework\TestCase;
use Sulu\Component\HttpKernel\SuluKernel;
use Sulu\Content\Domain\Model\DimensionContentInterface;

final class PageReferenceRepositoryTest extends TestCase
{
    public function testFindReferences(): void
    {
        $referenceRepository = new MockReferenceRepository();
        $repository = new PageReferenceRepository($referenceRepository);

        $mediaId = '123';
        $expectedResults = [['referenceTitle' => 'Test']];
        $referenceRepository->flatResultsToReturn = $expectedResults;

        $result = $repository->findReferences($mediaId);

        self::assertSame($expectedResults, $result);
        self::assertSame('media', $referenceRepository->requestedFilters['resourceKey']);
        self::assertSame('pages', $referenceRepository->requestedFilters['referenceResourceKey']);
        self::assertSame($mediaId, $referenceRepository->requestedFilters['resourceId']);
        self::assertSame(DimensionContentInterface::STAGE_LIVE, $referenceRepository->requestedFilters['referenceContext']);
    }
}
