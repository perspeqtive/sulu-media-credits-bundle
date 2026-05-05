<?php

declare(strict_types=1);

namespace PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Domain\Url;

use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepository;
use PERSPEQTIVE\MediaCreditsBundle\Domain\Url\UrlRepositoryByTypeInterface;
use PERSPEQTIVE\MediaCreditsBundle\Tests\Unit\Mocks\Domain\Url\MockUrlRepositoryByType;
use PHPUnit\Framework\TestCase;

final class UrlRepositoryTest extends TestCase
{
    public function testFindIteratesRepositories(): void
    {
        $repo1 = new MockUrlRepositoryByType([], false);
        $repo2 = new MockUrlRepositoryByType([ '1' => 'https://example.com'], true);


        $repository = new UrlRepository([$repo1, $repo2]);
        $result = $repository->find('1', 'pages', 'de');

        self::assertSame('https://example.com', $result);
    }

    public function testFindReturnsNullIfNoRepoResponsible(): void
    {
        $repo1 = new MockUrlRepositoryByType([], false);

        $repository = new UrlRepository([$repo1]);
        $result = $repository->find('id1', 'pages', 'de');

        self::assertNull($result);
    }

    public function testConstructorThrowsExceptionOnInvalidRepo(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('All url repositories must implement UrlRepositoryByTypeInterface');

        new UrlRepository([new \stdClass()]);
    }
}
