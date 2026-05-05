<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\References;

use Exception;
use PERSPEQTIVE\MediaCreditsBundle\Domain\References\ReferenceFinderRepository;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\References\MockReferenceByTypeRepository;
use PHPUnit\Framework\TestCase;
use stdClass;

use function iterator_to_array;

final class ReferenceFinderRepositoryTest extends TestCase
{
    public function testFindReferencesIteratesRepositories(): void
    {
        $repo1 = new MockReferenceByTypeRepository(['ref1']);
        $repo2 = new MockReferenceByTypeRepository(['ref2', 'ref3']);

        $repository = new ReferenceFinderRepository([$repo1, $repo2]);
        $result = iterator_to_array($repository->findReferences('1'));

        self::assertSame(['ref1', 'ref2', 'ref3'], $result);
    }

    public function testConstructorThrowsExceptionOnInvalidRepo(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('All reference repositories must implement ReferenceByTypeRepositoryInterface');

        new ReferenceFinderRepository([new stdClass()]);
    }
}
