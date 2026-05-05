<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Adapter\Sulu\References;

use PERSPEQTIVE\MediaCreditsBundle\Adapter\Sulu\References\ArticleReferenceRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Sulu\MockReferenceRepository;
use PHPUnit\Framework\TestCase;
use Sulu\Component\HttpKernel\SuluKernel;

final class ArticleReferenceRepositoryTest extends TestCase
{
    public function testFindReferences(): void
    {
        $referenceRepository = new MockReferenceRepository();
        $repository = new ArticleReferenceRepository($referenceRepository);

        $mediaId = '123';
        $expectedResults = [['referenceTitle' => 'Test']];
        $referenceRepository->flatResultsToReturn = $expectedResults;

        $result = $repository->findReferences($mediaId);

        self::assertSame($expectedResults, $result);
        self::assertSame('media', $referenceRepository->requestedFilters['resourceKey']);
        self::assertSame('articles', $referenceRepository->requestedFilters['referenceResourceKey']);
        self::assertSame($mediaId, $referenceRepository->requestedFilters['resourceId']);
        self::assertSame(SuluKernel::CONTEXT_WEBSITE, $referenceRepository->requestedFilters['referenceContext']);
    }
}
